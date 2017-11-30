<?php

namespace Dexel\Authentication\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Model\User\User;
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
      $user = User::where(['forgot_token'=>$token,'email'=>$request->email])->first();
      if(!$user)
      {
        abort('404');
      }
      return View('auth.resetpassword',['email'=>$request->email,'token'=>$token]);
    }
     

    
    public function update(Request $request,$token)
    {
      $input = $request->all();
      $password=$request->password;
      $user = User::where(['forgot_token'=>$token,'email'=>$input['email']])->first();

      if(!$user)
      {
        abort('404');
      }
       $messages = array(
                  'password.required' => 'Please enter new password',
                );
      $rules = array(
      'password'      => 'required|min:6',
      'password_confirmation' => 'required|same:password'
          );
      $validator = Validator::make(Input::all(), $rules, $messages);
      if ($validator->fails())
      {
        return redirect('user/password/reset/'.$token.'?email='.$input['email'])->withErrors($validator);
      }
      $validator->after(function($validator) {
        //dd("kk");
         if (!Auth::validate(['email' => Auth::guard('user')->user()->email, 'password' => $this->input('password')]))
   {
       $validator->errors()->add('password', 'Invalid password');
   }
 });
      
      {
        $user = User::where(['forgot_token'=>$token,'email'=>$input['email']])->first();
        $user->password=Hash::make($password);//dd($update->password);
        $user->save();
        return redirect('/')->with('message','Password reset successfully');
       }
    }

public function activateuser(Request $request,$token)
{
    //dd($token);
      //dd($request->email);
    $record = User::where(['forgot_token'=>$token,'email'=>$request->email])->where('active',0)->first();//dd($record);
    if(count($record)==1){
        User::where('email',$record->email)->update(['active'=>1,'token'=>'']);
        return redirect('email.activation')->with('activatesuccess','Your account successfully activated');
    }
        return redirect('email.activation')->with('activatefailure','Your account not activated. please contact admin');
}






  }



  /*$credentials = array('email' => Input::get('email'));
 
  return Password::reset($credentials, function($user, $password)
  {
    $user->password = Hash::make($password);
 
    $user->save();
 
    return Redirect::to('login')->with('flash', 'Your password has been reset');
  });
    }*/
   


    

