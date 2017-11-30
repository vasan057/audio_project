<?php

namespace Dexel\Authentication\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Hash;
use DB;
use App\Models\Users;
use App\Models\Admins;
use App\Models\Social;
use App\Models\UsersProfile;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

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
    
    public function getLoginForm()
    {
        if(Auth::guard('user')->check())
        {
            return redirect('/');
        }
        Session::put('url.intended',\URL::previous());
        return view('authentication::user.login');
    }
    
     public function authenticate()
    {
        $email = $this->request->input('username');
        $password = $this->request->input('password');
         
        if (auth()->guard('user')->attempt(['email' => $email, 'password' => $password,'active'=> '1', 'email_verified' => '1'])) 
        {
            return redirect()->to(Session::get('url.intended'))->with(['logged_in'=>'yes']);
            //return redirect()->intended(Session::get('url.intended'))->with(['logged_in'=>'yes']);
        }
        else
        {
            return redirect('login')->with('message', 'Invalid Login Credentials !')->withInput();
        }
    }
    
    
    public function getLogout() 
    {
        auth()->guard('user')->logout();
        //return redirect()->intended('login');
        return redirect('/')->with(['logged_in'=>'no']);
    }
    public function redirectToProvider($provider)
    {

        $providerKey = \Config::get('services.' . $provider);
        if (empty($providerKey)) {
            abort(403, 'Unauthorized action.');

        }
        Session::put('url.intended',\URL::previous());
        return \Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider)
    {
       return DB::transaction(function () use ($provider)
       {        
        try
        {
            if ($this->request->input('error') != '')
            {
                return redirect('/');
            }

            $user = \Socialite::driver($provider)->user();
            $userAdmin = Admins::where('email', '=', $user->email)->first();
            if($userAdmin)
            {
                //user is already registered as coach
                return redirect('login/coach');
            }
            $userCheck = Users::where('email', '=', $user->email)->first();
            if (!empty($userCheck)) {
                $socialUser = $userCheck;
                //check in social table
                $sameSocialId = Social::where('social_id', '=', $user->id)
                    ->where('provider', '=', $provider )
                    ->first();
                if (empty($sameSocialId)) {
                    //create new
                    $socialData = new Social;
                    $socialData->social_id = $user->id;
                    $socialData->provider= $provider;
                    $socialUser->social()->save($socialData);

                    $socialUser->email_verified = '1';
                    $socialUser->save();
                }
            }
            else {
                $sameSocialId = Social::where('social_id', '=', $user->id)
                    ->where('provider', '=', $provider )
                    ->first();
                if (empty($sameSocialId)) {
                    //create new
                    $newSocialUser = new Users;
                    if(!$user->email)
                    {
                        $newSocialUser->email = $user->id.'@'.$provider.'.com';
                    }
                    else
                    {
                        $newSocialUser->email = $user->email;
                    }
                    $fullname = explode(' ', $user->name,2);
                    if(!isset($fullname[1]))
                    {
                        $fullname[1]=$fullname[0];
                    }
                    $newSocialUser->fname = $fullname[0];
                    $newSocialUser->lname = $fullname[1];
                    $newSocialUser->phone = ' ';
                    $newSocialUser->email_verified = '1';
                    $newSocialUser->active = '1';
                    $newSocialUser->password = bcrypt(str_random(16));
                    $newSocialUser->save();
                    if(isset($user->avatar_original))
                    {
                        $profile_input['photo'] = $user->avatar_original;
                    }
                    else
                    {
                        $profile_input['photo'] = '/profile/coach/default.png';
                    }
                    $profile = new UsersProfile($profile_input);
                    $newSocialUser->profile()->save($profile);

                    $socialData = new Social;
                    $socialData->social_id = $user->id;
                    $socialData->provider= $provider;
                    $newSocialUser->social()->save($socialData);
                    $socialUser = $newSocialUser;
                    //send email
                }
                else {
                    //Load existing user
                    $socialUser = $sameSocialId->user;
                    $socialUser->profile()->update(['photo' => $user->avatar_original]);
                }
            }
            auth()->guard('user')->login($socialUser, true);
            return redirect()->to(Session::get('url.intended'))->with(['logged_in'=>'yes']);
        }
        catch (Exception $e)
        {
             return redirect('/');
        }
       }); 
    }
    public function getProfile() 
    {
        $user = Auth::guard('user')->user();
        return view('authentication::user.profile',['user'=>$user]);
    }    
    public function postProfile() 
    {
        $login_input = $this->request->only('fname','lname','phone','password','confirm_password');
        $profile_input = $this->request->only('gender','dob','about','address');
        $profile_input['photo'] = $this->request->file('photo',NULL);
        $validator = Users::validation_edit(array_merge($login_input,$profile_input));
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if(isset($login_input['password']) && ($login_input['password']))
        {
            $login_input['password'] = \Hash::make($login_input['password']);
        }
        else
        {
            unset($login_input['password']);    
        }
        unset($login_input['confirm_password']);
        $user = Auth::guard('user')->user();
        $user->update($login_input);
        $profile_input['dob'] = date('Y-m-d',strtotime($profile_input['dob']));
        if(isset($profile_input['photo']) && ($profile_input['photo']))
        {
        try
            {
                $imageFileName = "/profile/user/".$user->id."/".time() . '.' . $profile_input['photo']->getClientOriginalExtension();
                $s3 = \Storage::disk('s3');
                $s3->deleteDirectory(env('S3_ASSET_PATH','assets')."/profile/user/".$user->id);
                $s3->put(env('S3_ASSET_PATH','assets').$imageFileName, file_get_contents($profile_input['photo']), 'public');
                $profile_input['photo'] = $imageFileName;
            }
            catch (Exception $e)
            {
                //put default image
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
            }
        }
        else
        {
            unset($profile_input['photo']);
        }
        $user->profile->update($profile_input);
        return redirect('myprofile')->with(['message'=>'Updated successfully!']);
    }
}
