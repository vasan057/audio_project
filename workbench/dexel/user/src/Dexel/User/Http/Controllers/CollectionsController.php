<?php namespace Dexel\User\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\Users;
use Dexel\User\Models\CollectionsModel;
/**
 * The CollectionsController facade.
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class CollectionsController extends Controller
{
    public function __construct(Request $request)
    {
       $this->request =$request;
    }
    public function index()
    {
        $collections = CollectionsModel::with(['playlists','playlists.category','playlists.audios','createdby'])
        ->where(['created_by'=>Auth::guard('user')->id()]);
        $order_by = 'desc';
        $collections = $collections->orderBy('created_at', $order_by)->paginate(12);
        if(!$collections)
        {
            abort(404);
        }
        //dd($collections);
        return view('user::collections',['collections'=>$collections]);
    }
    public function store()
    {
        $inputs = $this->request->only('playlist_id','action');
        $validator = CollectionsModel::validation($inputs);       
        if ($validator->fails())
        {
            $result['error']= $validator;
            $result['code']= 'validation';
            return response()->json();
        }
        $inputs['created_by']= Auth::guard('user')->id();
        if($inputs['action'] == 'add')
        {
            if($collection = CollectionsModel::withTrashed()->where(['playlist_id'=>$inputs['playlist_id'],'created_by'=>$inputs['created_by']])->first())
            {
                $collection->restore();
            }
            else
            {
                CollectionsModel::create($inputs);
            }
            $result['code']= 'success';
            $result['action']= 'remove';
        }
        else if($inputs['action'] == 'remove')
        {
            if($collection = CollectionsModel::withTrashed()->where(['playlist_id'=>$inputs['playlist_id'],'created_by'=>$inputs['created_by']])->first())
            {
                $collection->delete();
            }
            $result['code']= 'success';
            $result['action']= 'add';
        }
        return response()->json($result);
    }
}
