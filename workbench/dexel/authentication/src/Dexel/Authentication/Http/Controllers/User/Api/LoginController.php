<?php

namespace Dexel\Authentication\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use JWTFactory;
use App\Models\Users;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Social;
use DB;

class LoginController extends Controller
{

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  protected $request;
  protected $model_name;

  public function __construct(Request $request)
  {
      $this->request = $request;
      $this->model_name = 'user';
  }
  public function index()
  {
    //\Config::set('jwt.user' , "App\Models\Configuration");
    \Config::set('auth.defaults.guard' , "user");
    $credentials = $this->request->only('email','password');
    /*$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
     if($Android)
     {
       $credentials['type']='android';
     }*/
    try {
        $customClaims = ['model' => 'user'];
          if (! $token = JWTAuth::attempt($credentials,$customClaims)) {
            return api_response('6001','Invalid credentials',$this->model_name,null,401);
          }
    } catch (JWTException $e) {
        // something went wrong whilst attempting to encode the token
        return api_response('500','Could not create token','user',null,500);
    }
    return api_response('6000','token',$this->model_name,['token' => $token]);
  }
  public function getProfile() 
    {
        $user = JWTAuth::toUser();
        return api_response('6000','User Profile',$this->model_name,$user);
    }
    public function postProfile() 
    {
        $login_input = $this->request->only('fname','lname','phone','password','confirm_password');
        $profile_input = $this->request->only('gender','dob','about','address');
        $profile_input['photo'] = $this->request->file('photo',NULL);
        $validator = Users::validation_edit(array_merge($login_input,$profile_input));
        if ($validator->fails())
        {
            return api_response('6006','Validation error',$this->model_name,$validator->messages());
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
        $user = JWTAuth::toUser();
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
        return api_response('6000','Updated successfully',$this->model_name,$user);
    }
    public function redirectToProvider($provider)
    {
        $providerKey = \Config::get('services.' . $provider);
        if (empty($providerKey)) {
            abort(403, 'Unauthorized action.');

        }
        return api_response('6000','Updated successfully',$this->model_name,\Socialite::with($provider)->stateless()->redirect()->getTargetUrl());
        // dd(\Socialite::with('facebook')->stateless()->redirect());
        // return \Socialite::driver($provider)->stateless()->redirect();
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

            //$user = \Socialite::driver($provider)->user();
            $user = \Socialite::with('facebook')->stateless()->user();
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
            $token = JWTAuth::fromUser($socialUser);
            return api_response('6000','token',$this->model_name,['token' => $token]);
            return redirect()->to(Session::get('url.intended'))->with(['logged_in'=>'yes']);
        }
        catch (Exception $e)
        {
             return redirect('/');
        }
       }); 
    }
}