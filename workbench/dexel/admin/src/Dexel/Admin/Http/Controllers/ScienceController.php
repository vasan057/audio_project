<?php namespace Dexel\Admin\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sciences;
use App\Models\ScienceCategory;
use Auth;
use AWS;
/**
 * The ScienceController facade.
 *
 * @package Dexel\Admin\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class ScienceController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

	public function index()
    {
        //$sciences = Sciences::with('category','createdby')->where(['created_by'=>Auth::guard('admin')->id()])->orderBy('created_at', 'desc')->get();
        $sciences = Sciences::with('category','createdby')->orderBy('created_at', 'desc')->get();
        return view('admin::science.index',['sciences'=>$sciences]);
    }
    public function get($slug)
    {
        $category =  ScienceCategory::with('science')->where(['active'=>'1','slug'=>$slug])->first();
        if((!$category) || (!$category->science))
        {
            abort('404');
        }
        return view('admin::science.form',['science'=>$category->science]);
    }
    public function get_description($slug)
    {
        $science =  Sciences::select('description')->where(['slug'=>$slug])->first();
        if(!$science)
        {
            abort('404');
        }
        return $science->description;
        //return response()->json($science);
    }
    public function store($slug)
    {
         $category =  ScienceCategory::with('science')->where(['active'=>'1','slug'=>$slug])->first();
        //if((!$category) || (!$category->science))
        if(!$category)
        {
            abort('404');
        }
        $input = $this->request->only('title','short_description','description');
        $input['cover_img'] = $this->request->file('cover_img',NULL);
        $dom = new \DOMDocument;
        @$dom->loadHTML($input['description']);
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
                        'Key'        => env('S3_ASSET_PATH').'/sciences/articles/'.urldecode($resource['path']),
                        'CopySource' => implode('/', $resource),
                    ));
                    $image->setAttribute('src',cdn('sciences/articles/'.urldecode($resource['path'])));
                }
            }
        }
        $input['description'] = $dom->saveHTML();
                
        $input['slug']=str_replace(' ', '_', strtolower(trim($input['title'])));
        $validator = Sciences::validation($input);
        if ($validator->fails())
        {
            return back()->withErrors($validator);
        }
        
        $input['created_by'] = $input['updated_by'] = Auth::guard('admin')->id();
        $input['category_id'] = $category->id;
        $input['active'] = '1';
        if($category->science)
        {
            $science = $category->science;
            //slug can't be changed once created, bcz it may be already shared
            unset($input['slug']);
        }
        else
        {
            return abort('404');
            //will have this when create science is require
            $science = new Sciences();
        }
        foreach ($input as $key=>$value)
        {
            if($value)
            $science->$key = $value;
        }
        
        if($science->save())
        {
            if($input['cover_img'])
            {
                $imageFileName = "/sciences/".$science->id."/".$science->slug."_".time() . '.' . $input['cover_img']->getClientOriginalExtension();
                $s3 = \Storage::disk('s3');
                //remove old mages if any
                $s3->deleteDirectory(env('S3_ASSET_PATH','assets')."/sciences/".$science->id);
                $s3->put(env('S3_ASSET_PATH','assets').$imageFileName, file_get_contents($input['cover_img']), 'public');
                $science->cover_img = $imageFileName;
                $science->save();
            }
        }
        return redirect('coach/view/science/'.$slug);
    }
    public function view($slug)
    {
        $category =  ScienceCategory::with('science')->where(['active'=>'1','slug'=>$slug])->first();
        if((!$category) || (!$category->science))
        {
            abort('404');
        }

            return view('admin::science.view',['science'=>$category->science]);
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
