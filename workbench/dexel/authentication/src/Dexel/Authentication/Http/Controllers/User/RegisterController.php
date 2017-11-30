<?php

namespace Dexel\Authentication\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Mail\Userregistration;
use App\Models\Users;
use App\Models\UsersProfile;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use DB;
use Mail;
class RegisterController extends Controller
{
    //use CaptchaTrait;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $request;
    public function __construct(Request $request)
    {
        
        $this->request =$request;
    }

    public function getRegisterForm()
    {
        return view('authentication::user.register');
    }
    
        
 /**
     * Create a new user instance after a valid registration.
     *
     * @param  request  $request
     * @return User
     */
    
    protected function saveRegisterForm()
    {
        //dd($this->request->all());
        return DB::transaction(function()
        {
            $login_input = $this->request->only('fname','lname','phone','email','password','confirm_password','g-recaptcha-response');
            $profile_input = $this->request->only('gender','dob','about','address');
            $validator = Users::validation(array_merge($login_input,$profile_input));
            if ($validator->fails())
            {
                //dd($validator->messages());
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $login_input['password'] = \Hash::make($login_input['password']);
            $login_input['forgot_token']=base64_encode($login_input['email'].date("YmdHis"));
            unset($login_input['confirm_password']);
            unset($login_input['g-recaptcha-response']);
            $login_input['active']='1';
            $user = Users::create($login_input);
            
            if($user->id){
                $profile_input['dob'] = date('Y-m-d',strtotime($profile_input['dob']));
                if($profile_input['gender'] == 'M')
                    {
                        $profile_input['photo'] = '/profile/user/default_m.png';
                    }
                    else if($profile_input['gender'] == 'F')
                    {
                        $profile_input['photo'] = '/profile/user/default_f.png';
                    }
                    else
                    {
                        $profile_input['photo'] = '/profile/user/default.png';
                    }
                $profile = new UsersProfile($profile_input);
                $user->profile()->save($profile);
                try
                {
                    Mail::to($user->email)->send(new Userregistration($user));    
                }
                catch (\Exception $e)
                {
                // mail fialed    
                }
                
                return redirect('register')->with('message', 'Thank You! Please check your email to activate your account.');
            }else{
                return redirect('register')->with('message', 'Registration failed, please try again.');
            }
        });
    }
    public function activateuser($token)
    {
        $record = Users::where('forgot_token',$token)->where('email_verified','0')->first();
        if($record){
            //$record->active='1';
            $record->email_verified='1';
            $record->forgot_token=NULL;
            $record->save();
            return view('authentication::user.activation');
        }
        else{
            return redirect('login');
        }
    }

}
