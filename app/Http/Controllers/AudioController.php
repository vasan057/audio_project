<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Crypt;
use App\Models\Playlists;
use App\Models\PlaylistCategory;
use Auth;
/**
 * The AudioController facade.
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class AudioController extends Controller
{
    public function index($categoryTitle=NULL)
     {
        $categories = PlaylistCategory::with('createdby')->whereHas('createdby',function($q){
            $q->where('usertype','admin');
        })->where(['active'=>'1'])->get();
        $playlists = Playlists::with(['category','audios','createdby'])
        ->whereHas('createdby',function($q){
                $q->where('usertype','admin');
            })->whereHas('category',function($q){
                $q->where('active','1');
            })->where(['active'=>'1']);
        //dd($playlists);
        if($categoryTitle)
        {
            //only admin category
            $category = PlaylistCategory::with('createdby')->whereHas('createdby',function($q){
            $q->where('usertype','admin');
            })->where(['active'=>'1','title'=>$categoryTitle])->first();
            if(!$category)
            {
                abort(404);
            }
            $playlists = $playlists->where(['category_id'=>$category->id]);
        }
        /*if(Auth::guard('user')->check())
        {
            $order_by = 'desc';
        }
        else
        {
            //LIFO to restrict the access for new records
            $order_by = 'asc';
        }*/
        $order_by = 'desc';
        $playlists = $playlists->orderBy('created_at', $order_by)->paginate(12);
        if(!$playlists)
        {
            abort(404);
        }
        //dd($playlists);
        return view('web.playlists',['categories'=>$categories,'playlists'=>$playlists,'categoryTitle'=>$categoryTitle]);
     }
     public function rate_and_comment()
     {
        return view('web.rating_comment_list');
     }
}
