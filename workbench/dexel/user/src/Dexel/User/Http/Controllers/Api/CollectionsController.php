<?php namespace Dexel\User\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Users;
use Dexel\User\Models\CollectionsModel;
/**
 * The CollectionsController facade.
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class CollectionsController extends Controller
{
    protected $request;
    protected $model_name;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->model_name = 'collections';
    }
    public function index()
    {
        $collections = CollectionsModel::with(['playlists','playlists.category','playlists.audios','createdby'])
        ->where(['created_by'=>jwt_userid()]);
        $order_by = 'desc';
        $collections = $collections->orderBy('created_at', $order_by)->paginate(10);
        if(!$collections)
        {
            abort(404);
        }
        return api_response('8000','success',$this->model_name,$collections);
    }
    public function store()
    {
        $inputs = $this->request->only('playlist_id','action');
        $validator = CollectionsModel::validation($inputs);       
        if ($validator->fails())
        {
            $result['error']= $validator;
            $result['code']= 'validation';
            return api_response('8001','validation',$this->model_name,$validator->messages());
        }
        $inputs['created_by']= jwt_userid();
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
        }
        else if($inputs['action'] == 'remove')
        {
            if($collection = CollectionsModel::withTrashed()->where(['playlist_id'=>$inputs['playlist_id'],'created_by'=>$inputs['created_by']])->first())
            {
                $collection->delete();
            }
            $result['code']= 'success';
        }
        return api_response('8000','success',$this->model_name,$result);
    }
}
