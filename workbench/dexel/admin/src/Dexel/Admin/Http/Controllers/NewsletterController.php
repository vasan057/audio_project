<?php namespace Dexel\Admin\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Dexel\Contact\Models\ContactModel;
use Auth;
use Mail;
use App\Mail\NewsLetter;
use App\Models\Users;
use App\Models\Admins;
use Dexel\User\Models\SubscribeModel;
use DB;
use AWS;
/**
 * The NewsletterController facade.
 *
 * @package Dexel\Admin\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class NewsletterController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

	public function index()
    {
        //$contacts = ContactModel::orderBy('created_at', 'desc')->paginate(10);
        return view('admin::subscribe.index');
    }
    public function preview()
    {
        $inputs = $this->request->only('subject','message');
        return view('mail.subscribe.newsletter')->with(['messsage'=>nl2br($inputs['message'])]);
    }
    public function newsletter()
    {
        $inputs = $this->request->only('subscribers','users','coaches','emails','subject','message');
        //$inputs = $this->request->all();
        //dd($inputs);
        $messages = [];
        $rules=[
                'subject' => 'required|max:64',
                'message' => 'required|max:20000',
                ];
        $nbr = count($inputs['emails'])-1;
        foreach(range(0, $nbr) as $index)
        {
            $rules['emails.'.$index] = 'email|max:256';
        }
        $validator = \Validator::make($inputs, $rules, $messages);

        if ($validator->fails())
        {
            $result['code']='validation';
            $result['errors']= $validator->messages();
            return response()->json($result);
        }
        $email_arr=[];

        $dom = new \DOMDocument;
        @$dom->loadHTML($inputs['message']);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $image) {
            $s3_image = $image->getAttribute('src');
            $find_str = 's3-'.env('TEMP_AWS_REGION').'.amazonaws.com/'.env('TEMP_S3_BUCKET');
            if (strpos($s3_image, $find_str) !== false)
            {
                //echo $s3_image;
                if($resource = $this->getS3Info($s3_image))
                {
                    $s3 = AWS::createClient('s3');
                    $s3->copyObject(array(
                        'Bucket'     => env('S3_BUCKET'),
                        'Key'        => env('S3_ASSET_PATH').'/newsletter/'.urldecode($resource['path']),
                        'CopySource' => implode('/', $resource),
                    ));
                    $image->setAttribute('src',cdn('newsletter/'.urldecode($resource['path'])));
                }
            }
        }
        $inputs['message'] = $dom->saveHTML();

        if($inputs['coaches'] == 'yes')
        {
            $coaches = Admins::select('email')->where(['usertype'=>'coach','active'=>'1'])->get();
            
            foreach ($coaches as $coach) {
                Mail::to($coach->email)->queue(new NewsLetter($inputs['subject'],nl2br($inputs['message'])));
            }
        }
        if($inputs['users'] == 'yes')
        {
            $users = Users::select('email')->where(['active'=>'1'])->get();
            
            foreach ($users as $users) {
                Mail::to($users->email)->queue(new NewsLetter($inputs['subject'],nl2br($inputs['message'])));
            }
        }
        if($inputs['subscribers'] == 'yes')
        {
            $users = SubscribeModel::with('user')->get();
            
            foreach ($users as $user) {
            if($user->user)
                {
                    Mail::to($user->user->email)->queue(new NewsLetter($inputs['subject'],nl2br($inputs['message'])));
                }
                else
                {
                    Mail::to($user->email)->queue(new NewsLetter($inputs['subject'],nl2br($inputs['message'])));
                }
            }
        }
        if(isset($inputs['emails']))
        {
            foreach ($inputs['emails'] as $email) {
            Mail::to($email)->queue(new NewsLetter($inputs['subject'],nl2br($inputs['message'])));
            }
        }
        $result['code']='success';
        return response()->json($result);
    }
    public function find_user()
    {
        $search_value = $this->request->get('term',NULL);
        //dd($search_value);
        $columns = ['fname','lname','email','phone'];
        $query = Users::select('users.id',DB::raw("CONCAT(users.fname,' ',users.lname) as label"),'users.email');
        //$query->join('users_profile', 'users.id', '=', 'users_profile.user_id');
        $query->where('users.fname', 'like','%'.$search_value.'%');
        foreach($columns as $column)
        {
          $query->orWhere('users.'.$column, 'like','%'.$search_value.'%');
        }
        $coaches = $query->get();
        return response()->json($coaches);
    }
    public function subscribe_list()
    {
        $orderby=$this->request->get('sortby','created_at');
        $orderby_option=$this->request->get('sortby_option','desc');
        $subscribers = SubscribeModel::orderBy($orderby, $orderby_option)->paginate(10);
        return view('admin::subscribe.subscribe_list',['subscribers'=>$subscribers]);
    }
    public function subscribe_remove($id)
    {
        $subscriber = SubscribeModel::find($id);
        if(!$subscriber)
        {
            abort(404);
        }
        $subscriber->delete();
        return back();
    }
    public function getS3Info($url)
    {
        $path = explode('.amazonaws.com/',$url);
        if(isset($path[1]))
        {
            $path = explode('/',$path[1],2);
            if(isset($path[0]) && isset($path[1]))
            {
                return(['bucket'=>$path[0],'path'=>$path[1]]);
            }
            else
            {
                return false;       
            }
        }
        else
        {
            return false;
        }
        /*if(! preg_match('/(?:.amazonaws.com\/([^\/]+)|:\/\/([^.]+).amazonaws\.com)\/([^\/]+)/', $url, $a))
        {
        echo "=====================";
        return false;
        }

        $bucket = isset($a[2]) ? $a[2] : $a[1];
        $resource = $a[3];

        return array('bucket' => $bucket, 'resource' => $resource);*/
    }
}
