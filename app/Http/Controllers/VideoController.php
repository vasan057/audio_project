<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Crypt;
use App\Models\Videos;
use App\Models\VideoViews;
use Auth;
/**
 * The VideoController facade.
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class VideoController extends Controller
{
    public function index()
     {
     	$videos = Videos::with('category','essence','createdby')->where(['active'=>'1'])->orderBy('created_at', 'desc')->get();
         return view('web.videos',['videos'=>$videos]);
     }
     public function detail($id)
     {
     	$id=Crypt::decrypt($id);
     	$video = Videos::with('category','essence','createdby')->where(['active'=>'1','id'=>$id])->first();
     	if(!$video)
     	{
     		abort(404);
     	}
     	$video_view = new VideoViews(['created_by'=>Auth::guard('user')->id()]);
     	$video->views()->save($video_view);
     	$related_videos = Videos::with('category','essence','createdby')->where(['active'=>'1','category_id'=>$video->category_id])->take(4)->get();
         return view('web.video_detail',['video'=>$video,'related_videos'=>$related_videos]);
     }

     public function category($category_id)
      { $category_id=Crypt::decrypt($category_id);
        $videos = Videos::with('category','essence','createdby')->where(['active'=>'1', 'category_id'=>$category_id])->orderBy('created_at', 'desc')->get();
          return view('web.videos',['videos'=>$videos]);
      }
}
