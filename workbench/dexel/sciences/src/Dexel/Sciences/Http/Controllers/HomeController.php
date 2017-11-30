<?php namespace Dexel\Sciences\Http\Controllers;

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

        //category list
        $science_category = ScienceCategory::where(['active'=>'1'])->get();
        return view('sciences::index',['science'=>$category->science,'science_category'=>$science_category,'categorySlug'=>$category->slug]);
    }
}
