<?php namespace Dexel\User\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Users;
use Dexel\User\Models\SubscribeModel;
/**
 * The SubscribeController facade.
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class SubscribeController extends Controller
{
    protected $request;
    protected $model_name;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->model_name = 'Subscribe';
    }
    public function store()
    {
        $inputs = $this->request->only('email','name','g-recaptcha-response');
        $validator = SubscribeModel::validation($inputs,'no');       
        if ($validator->fails())
        {
            return api_response('9001','validation',$this->model_name,$validator->messages());
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
        return api_response('9000','Success',$this->model_name,[]);
    }
    public function unsubscribe()
    {
        $inputs = $this->request->only('email');
        if(jwt_userid())
        {
            $subscribe = SubscribeModel::withTrashed()->where('user_id',jwt_userid())->first();
        }
        else
        {
            $subscribe = SubscribeModel::withTrashed()->where('email',$inputs['email'])->first();
        }
        if($subscribe)
        {
            $subscribe->delete();
        }
        else
        {
            abort(404);
        }
        return api_response('9000','Success',$this->model_name,[]);
    }
}
