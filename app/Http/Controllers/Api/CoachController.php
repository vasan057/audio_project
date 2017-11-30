<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins;
use App\Models\Playlists;
use App\Models\PlaylistCategory;
use App\Models\AudioComments;
use Crypt;
use Auth;
class CoachController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $request;
    protected $model_name;

    public function __construct(Request $request)
    {
       $this->request =$request;
       $this->model_name = 'coaches';
    }

    public function index()
    {
        $coaches = Admins::with('profile')->where(['usertype'=>'coach','active'=>'1','email_verified'=>'1'])->paginate(10);
        return api_response('7000','success',$this->model_name,$coaches);
    }

    public function coachprofile($id)
    {
        $id = base64_decode($id);
        $coach = Admins::with('profile','expertise','followers')->where(['active'=>'1','id'=>$id])->first();
        if(!$coach)
        {
            abort(404);
        }
        //redirect to all aduio page , where it displays only admin audios
        elseif($coach->usertype != 'coach')
        {
            return redirect('api/v1/playlists');
        }
        $follow = \Dexel\Follow\Models\FollowModel::where(['created_by'=>Auth::guard('user')->id(),'coach_id'=>$id])->first();
        $count['playlists'] = Playlists::where(['active'=>'1','created_by'=>$id])->count();
        $recent['playlists'] = Playlists::where(['active'=>'1','created_by'=>$id])->orderBy('created_at', 'desc')->take(3)->get();
        return api_response('7000','success',$this->model_name,['count'=>$count,'coach'=>$coach,'follow'=>$follow,'recent'=>$recent]);
    }
    public function audios($id,$categoryTitle=NULL)
     {
        $id=base64_decode($id);
        $coach = Admins::where(['usertype'=>'coach','active'=>'1','id'=>$id])->first();
        if(!$coach)
        {
            abort(404);
        }
        $playlists = Playlists::with(['category','audios','createdby'])->whereHas('category',function($q){
                $q->where('active','1');
            })->where(['active'=>'1','created_by'=>$id]);
        if($categoryTitle)
        {
            $category = PlaylistCategory::where(['active'=>'1','title'=>$categoryTitle,'created_by'=>$id])->first();
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
        return api_response('7000','success',$this->model_name,$playlists);
     }

}
