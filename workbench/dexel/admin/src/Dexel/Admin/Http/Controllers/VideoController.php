<?php namespace Dexel\Admin\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Videos;
use Auth;
/**
 * The VideoController facade.
 *
 * @package Dexel\Admin\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class VideoController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $videos = Videos::with('category','essence')->where(['created_by'=>Auth::guard('admin')->id()])->orderBy('created_at', 'desc')->get();
        return view('admin::video.index',['videos'=>$videos]);
    }
    public function store()
    {
        $input = $this->request->only('title','active','approved','short_description','description','video_url','author','isfree','category','essence','img');
        $input['cover_img'] = $this->request->file('cover_img');
        
        $input['slug']=str_replace(' ', '_', strtolower(trim($input['title'])));
        $validator = Videos::validation($input);
        if ($validator->fails())
        {
            $output['code']='validation';
            $output['errors']=$validator->messages();
            return response()->json($output);
        }
        $input['approved']=1;
        $input['created_by'] = $input['updated_by'] = Auth::guard('admin')->id();
        $input['category_id'] = $input['category'];
        $input['essence_id'] = $input['essence'];
        unset($input['category']);
        unset($input['essence']);
        if($video = Videos::create($input))
        {
            $imageFileName = "/video/".$video->id."/".$video->slug."_".time() . '.' . $input['cover_img']->getClientOriginalExtension();
            $s3 = \Storage::disk('s3');
            $s3->put(env('S3_ASSET_PATH','assets').$imageFileName, file_get_contents($input['cover_img']), 'public');
            $video->cover_img = $imageFileName;
            $video->save();
        }
        $output['code']='success';
        return response()->json($output);
    }
    public function get($slug)
    {
        $video = Videos::with('category','essence')->where(['created_by'=>Auth::guard('admin')->id(),'slug'=>$slug])->first();
        if($video)
        {
            return view('admin::video.view',['video'=>$video]);
        }
        else
        {
            abort('404');
        }
    }
    public function view($slug)
    {
        $video = Videos::with('category','essence')->where(['created_by'=>Auth::guard('admin')->id(),'slug'=>$slug])->first();
        if($video)
        {
            return view('admin::video.view',['video'=>$video]);
        }
        else
        {
            abort('404');
        }
    }
    public function remove($slug)
    {
        $video = Videos::with('category','essence')->where(['created_by'=>Auth::guard('admin')->id(),'slug'=>$slug])->first();
        if($video)
        {
            $video->delete();
        }
        else
        {
            abort('404');
        }
    }
}
