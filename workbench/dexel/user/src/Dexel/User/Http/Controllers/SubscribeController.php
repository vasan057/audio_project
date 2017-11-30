<?php namespace Dexel\User\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\Users;
use Dexel\User\Models\SubscribeModel;
/**
 * The SubscribeController facade.
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class SubscribeController extends Controller
{
    public function __construct(Request $request)
    {
       $this->request =$request;
    }
    public function index()
    {
        return view('user::subscribe');
    }
    public function store()
    {
        $inputs = $this->request->only('email','name','g-recaptcha-response');
        $validator = SubscribeModel::validation($inputs);       
        if ($validator->fails())
        {
            return view('user::subscribe')->withErrors($validator);
        }
        $user = Users::withTrashed()->where('email',$inputs['email'])->first();
        if($user)
        {
            $subscribe = SubscribeModel::withTrashed()->where('user_id',$user->id)->orWhere('email',$inputs['email'])->first();
            if($subscribe)
            {
                $subscribe->user_id = $user->id;
                $subscribe->email = NULL;
                $subscribe->name = NULL;
                $subscribe->deleted_at = NULL;
                $subscribe->save();
            }
            else
            {
                SubscribeModel::create(['user_id'=>$user->id]);
            }
        }
        else
        {
            $subscribe = SubscribeModel::withTrashed()->where('email',$inputs['email'])->first();
            if($subscribe)
            {
                $subscribe->deleted_at = NULL;
                $subscribe->save();
            }
            else
            {
                SubscribeModel::create(['email'=>$inputs['email'],'name'=>$inputs['name']]);
            }
        }
        return view('user::subscribeSuccess');
    }
    public function storeAction($action)
    {
        $user = Auth::guard('user')->user();
        if($action == 'subscribe')
        {
            $subscribe = SubscribeModel::withTrashed()->where('user_id',$user->id)->orWhere('email',$user->email)->first();
            if($subscribe)
            {
                $subscribe->user_id = $user->id;
                $subscribe->email = NULL;
                $subscribe->name = NULL;
                $subscribe->deleted_at = NULL;
                $subscribe->save();
            }
            else
            {
                SubscribeModel::create(['user_id'=>$user->id]);
            }
            $action = "Unsubscribe";
        }
        else
        {
            SubscribeModel::where('user_id',$user->id)->delete();
            $action = "Subscribe";
        }
        return response()->json(['action'=>$action]);
    }
}
