<?php
namespace Dexel\Authentication\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Validator;
use App\Mail\Userforgotpassword;
use Mail;

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

  //use SendsPasswordResetEmails;

  /**
   * Create a new controller instance.
   *
   * @return void
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
            'email' => 'required|email|max:255|exists:users',
            'g-recaptcha-response' => 'required|recaptcha',
            );
     $validator = Validator::make($inputs, $rules, $messages);
        if ($validator->fails()) {
            return redirect('forgot')->withErrors($validator)->withInput();
        }
    $user = Users::where(['email'=>$inputs['email'],'active'=>'1'])->first();
    if(!$user)
    {
      $validator->errors()->add('email', 'The account does not exist or is inactive');
      return redirect('forgot')->withErrors($validator)->withInput();
    }
    $user->forgot_token = md5($user->email.rand().time());
    $user->save();
    try
    {
        Mail::to($user->email)->send(new Userforgotpassword($user));    
    }
    catch (\Exception $e)
    {
    // mail fialed    
    }
    return redirect('forgot')->with('message', 'Please check your e-mail for reset link.');
  }
  public function getReset($token)
  {
    $user = Users::where(['forgot_token'=>$token,'active'=>'1'])->first();
    if(!$user)
    {
      abort('404');
    }
    return view('authentication::user.reset');
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
        return redirect('reset/user/'.$token)->withErrors($validator);
    }
    $user = Users::where(['forgot_token'=>$token,'active'=>'1'])->first();
    if(!$user)
    {
      abort('404');
    }
    $user->password = \Hash::make($inputs['password']);
    $user->forgot_token=NULL;
    $user->save();
    return view('authentication::user.resetSuccess');
  }
}
 

     



















    


      
