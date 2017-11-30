<?php namespace Dexel\Admin\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Auth;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Filesystem\Filesystem;
/**
 * The UsersController facade.
 *
 * @package Dexel\Admin\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class UsersController extends Controller
{
    protected $request;

    public function __construct(Factory $storage, Filesystem $file,Request $request)
    {
        $this->storage = $storage;
        $this->file = $file;
        $this->request = $request;
    }

	public function index()
    {
        $users = Users::with('profile')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin::user.index',['users'=>$users]);
    }

    public function activate($userId)
    {
        $id = base64_decode($userId);
        $user = Users::find($id);
        if(!$user)
        {
            abort(404);
        }
        $user->active = '1';
        $user->updated_by = Auth::guard('admin')->id();
        $user->save();
        return response()->json(['code'=>'success','text'=>'fa-eye','action'=>'user/deactivate/'.$userId]);
    }
    public function deactivate($userId)
    {
        $id = base64_decode($userId);
        $user = Users::find($id);
        if(!$user)
        {
            abort(404);
        }
        $user->active = '0';
        $user->updated_by = Auth::guard('admin')->id();
        $user->save();
        return response()->json(['code'=>'success','text'=>'fa-eye-slash','action'=>'user/activate/'.$userId]);
    }
}
