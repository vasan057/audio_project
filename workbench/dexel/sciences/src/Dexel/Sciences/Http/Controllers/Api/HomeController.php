<?php namespace Dexel\Sciences\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dexel\Sciences\Facades\Sciences;
use App\Models\ScienceCategory;
use App\Models\ScienceViews;
use Auth;
/**
 * The HomeController facade.
 *
 * @package Dexel\Sciences\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class HomeController extends Controller
{
    public function index($slug=NULL)
    {
        if($slug)
        {
            $category =  ScienceCategory::with('science')->where(['active'=>'1','slug'=>$slug])->first();
        }
        else
        {
            $category =  ScienceCategory::with('science')->where(['active'=>'1'])->first();
        }
    	if((!$category) || (!$category->science))
    	{
    		abort('404');
    	}
    	//add count
        $science_view = new ScienceViews(['created_by'=>Auth::guard('user')->id()]);
        $category->science->views()->save($science_view);
        return api_response('4000','success','science',$category->science);   
    }
    public function categories()
    {
        $categories = ScienceCategory::select('title','slug')->where(['active'=>'1'])->get();
        return api_response('4000','success','science',['categories'=>$categories]);   
    }
}
