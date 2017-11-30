<?php

namespace Dexel\Authentication\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins;
use Validator;
use App\Mail\Adminforgotpassword;
use Mail;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

  protected $request;

  public function __construct(Request $request)
  {
      $this->request = $request;
  }
  public function index()
  {

     return view('authentication::user.forgot');

  }

  public function postForgot()
  {
    $inputs = $this->request->only('email','g-recaptcha-response');
    $messages = array(
            'email.required' => 'Please enter email address',
            
            );
    $rules = array(
            'email' => 'required|email|max:255|exists:admins',
            'g-recaptcha-response' => 'required|recaptcha',
            );
     $validator = Validator::make($inputs, $rules, $messages);
        if ($validator->fails()) {
            return redirect('forgot/coach')->withErrors($validator)->withInput();
        }
    $coach = Admins::where(['email'=>$inputs['email'],'active'=>'1'])->first();
    if(!$coach)
    {
      $validator->errors()->add('email', 'The account does not exist or is inactive');
      return redirect('forgot/coach')->withErrors($validator)->withInput();
    }
    $coach->forgot_token = md5($coach->email.rand().time());
    $coach->save();
    try
    {
        Mail::to($coach->email)->send(new Adminforgotpassword($coach));    
    }
    catch (\Exception $e)
    {
    // mail fialed    
    }
    return redirect('forgot/coach')->with('message', 'Please check your e-mail for reset link.');
  }
  public function getReset($token)
  {
    $coach = Admins::where(['forgot_token'=>$token,'active'=>'1'])->first();
    if(!$coach)
    {
      abort('404');
    }
    return view('authentication::admin.reset');
  }
  public function postReset($token)
  {
    $inputs = $this->request->only('password','password_confirmation','g-recaptcha-response');
    $messages = array(
                  'password.required' => 'Please enter new password',
                );
      $rules = array(
      'password'      => 'required|min:6',
      'password_confirmation' => 'required|same:password',
      'g-recaptcha-response' => 'required|recaptcha',
          );
    $messages = [];
    $validator = Validator::make($inputs, $rules, $messages);
    if ($validator->fails()) {
        return redirect('reset/coach/'.$token)->withErrors($validator);
    }
    $coach = Admins::where(['forgot_token'=>$token,'active'=>'1'])->first();
    if(!$coach)
    {
      abort('404');
    }
    $coach->password = \Hash::make($inputs['password']);
    $coach->forgot_token=NULL;
    $coach->save();
    return view('authentication::admin.resetSuccess');
  }
}
