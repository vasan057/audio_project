<?php namespace Dexel\Admin\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dexel\Follow\Models\FollowModel;
use Auth;
/**
 * The FollowController facade.
 *
 * @package Dexel\Admin\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class FollowController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
	public function index()
    {
        $followers = FollowModel::with('createdby','createdby.profile')->where('coach_id',Auth::guard('admin')->id())->orderBy('created_at', 'desc')->paginate(10);
        return view('admin::follow.index',['followers'=>$followers]);
    }
    public function block($followId)
    {
        $id = base64_decode($followId);
        $follow = FollowModel::where(['id'=>$id,'coach_id'=>Auth::guard('admin')->id()])->first();
        if(!$follow)
        {
            abort(404);
        }
        $follow->blocked = '1';
        $follow->save();
        return response()->json(['code'=>'success','text'=>'fa-eye-slash','action'=>'unblock/'.$followId]);
    }
    public function unblock($followId)
    {
        $id = base64_decode($followId);
        $follow = FollowModel::where(['id'=>$id,'coach_id'=>Auth::guard('admin')->id()])->first();
        if(!$follow)
        {
            abort(404);
        }
        $follow->blocked = '0';
        $follow->save();
        return response()->json(['code'=>'success','text'=>'fa-eye','action'=>'block/'.$followId]);
    }
}
