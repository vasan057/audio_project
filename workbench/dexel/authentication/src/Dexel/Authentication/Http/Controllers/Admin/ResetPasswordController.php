<?php

namespace Dexel\Authentication\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Model\Admin\Admin;
use Validator;
use Mail;
use Auth;
use Hash;
use Session;
use DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function reset(Request $request,$token)
    {
      $admin = Admin::where(['forgot_token'=>$token,'email'=>$request->email])->first();
      if(!$admin)
      {
        abort('404');
      }
      return View('admin.auth.resetpassword',['email'=>$request->email,'token'=>$token]);
    }
    public function update(Request $request,$token)
    {
      $input = $request->all();
      $password=$request->password;
      $admin = Admin::where(['forgot_token'=>$token,'email'=>$input['email']])->first();

      if(!$admin)
      {
        abort('404');
      }
       $messages = array(
                  'password.required' => 'Please enter new password',
                );
      $rules = array(
      'password' => 'required|min:6',
      'password_confirmation' => 'required|same:password'
          );
      $validator = Validator::make(Input::all(), $rules, $messages);
      if ($validator->fails())
      {
        return redirect('admin/password/reset/'.$token.'?email='.$input['email'])->withErrors($validator);
      }
      $validator->after(function($validator) {
       
         if (!Auth::validate(['email' => Auth::guard('user')->admin()->email, 'password' => $this->input('password')]))
   {
       $validator->errors()->add('password', 'Invalid password');
   }
 });
      
      {
        $admin = Admin::where(['forgot_token'=>$token,'email'=>$input['email']])->first();
        $admin->password=Hash::make($password);
        $admin->save();
        return redirect('admin/login')->with('message','Password reset successfully');
       }
    }

}
