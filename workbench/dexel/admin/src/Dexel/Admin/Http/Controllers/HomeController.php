<?php namespace Dexel\Admin\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dexel\Admin\Facades\Admin;
use App\Models\Playlists;
use App\Models\Articles;
use App\Models\Videos;
use App\Models\Admins;
use App\Models\Users;
use App\Models\AudioViews;
use Auth;
use App\Models\AudioComments;
use App\Mail\Mailto;
/**
 * The HomeController facade.
 *
 * @package Dexel\Admin\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class HomeController extends Controller
{
	protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
	 public function index()
    {
        //$articles= Articles::where(['created_by'=>Auth::guard('admin')->id()])->count();
        //$videos = Videos::where(['created_by'=>Auth::guard('admin')->id()])->count();
        $recent['comments'] = AudioComments::with(['audio','createdby'])->whereHas('audio',function($q) {
            $q->where('created_by',Auth::guard('admin')->id());
        })->orderBy('created_at', 'desc')->take(4)->get();
        $count['playlists']= Playlists::where(['created_by'=>Auth::guard('admin')->id()])->count();
        if(Auth::guard('admin')->user()->usertype == 'admin')
        {
            $count['coaches'] = Admins::where(['active'=>'1','usertype'=>'coach'])->count();   
            $count['users'] = Users::where(['active'=>'1'])->count();
        }
        else
        {
            $count['followers'] = Auth::guard('admin')->user()->followers->count();
        }
        $count['play_count'] = AudioViews::with('audio')->whereHas('audio',function($q){
            $q->where(['created_by'=>Auth::guard('admin')->id()]);
        })->count();
        return view('admin::index',['count'=>$count,'recent'=>$recent]);
    }
    public function uploads()
    {
        return  redirect('coach/upload/audios');
        $playlists= Playlists::with('category','audios','createdby')->where(['created_by'=>Auth::guard('admin')->id()])->orderBy('created_at', 'desc')->take(3)->get();
        $articles= Articles::with('category','essence','views')->where(['created_by'=>Auth::guard('admin')->id()])->orderBy('created_at', 'desc')->take(3)->get();
        $videos = Videos::with('category','essence','views')->where(['created_by'=>Auth::guard('admin')->id()])->orderBy('created_at', 'desc')->take(3)->get();
        //dd($articles);
        return view('admin::uploads',['playlists'=>$playlists,'videos'=>$videos,'articles'=>$articles]);
    }
	public function profile()
	{
        $coach = Auth::guard('admin')->user();
        $count['articles']= Articles::where(['created_by'=>$coach->id])->count();
        $count['videos'] = Videos::where(['created_by'=>$coach->id])->count();
        $count['playlists'] = Playlists::where(['created_by'=>$coach->id])->count();
        $recent['playlists'] = Playlists::where(['active'=>'1','created_by'=>$coach->id])->orderBy('created_at', 'desc')->take(3)->get();
        $recent['comments'] = AudioComments::with(['audio','createdby'])->whereHas('audio',function($q) use ($coach){
            $q->where('created_by',$coach->id);
        })->orderBy('created_at', 'desc')->get();
        return view('admin::profile',['count'=>$count,'coach'=>$coach,'recent'=>$recent]);

			/*$playlists= Playlists::with('category','audios','createdby')->where(['created_by'=>Auth::guard('admin')->id()])->orderBy('created_at', 'desc')->take(4)->get();
			$articles= Articles::with('category','essence','views')->where(['created_by'=>Auth::guard('admin')->id()])->orderBy('created_at', 'desc')->take(4)->get();
			$videos = Videos::with('category','essence','views')->where(['created_by'=>Auth::guard('admin')->id()])->orderBy('created_at', 'desc')->take(4)->get();
			//dd($articles);
			return view('admin::profile',['playlists'=>$playlists,'videos'=>$videos,'articles'=>$articles]);*/
	}
    public function mailto()
    {
        return view('admin::mail-send.index',['email'=>$this->request->get('email')]);
    }
    public function send_mailto()
    {
        $inputs = $this->request->only('email','subject','message');
        $messages = [];
        $rules=[
                'email' => 'required|email',
                'subject' => 'required|max:64',
                'message' => 'required|max:20000',
                ];
        $validator = \Validator::make($inputs, $rules, $messages);
        if ($validator->fails())
        {
            $result['code']='validation';
            $result['errors']= $validator->messages();
            return response()->json($result);
        }
        \Mail::to($inputs['email'])->send(new Mailto($inputs['subject'],nl2br($inputs['message'])));
            
        $result['code']='success';
        return response()->json($result);
    }
    public function mailto_preview()
    {
        $inputs = $this->request->only('subject','message');
        return view('mail.coach.mailto')->with(['messsage'=>nl2br($inputs['message'])]);
    }
}
