<?php

namespace Dexel\Authentication\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Hash;
use App\Models\Expertise;
use App\Models\CustomExpertise;
use App\Models\Admins;
use App\Models\AdminsProfile;
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
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $request;
    public function __construct(Request $request)
    {
         $this->request = $request;
        //$this->middleware('guest', ['except' => 'logout']);
    }
    
    public function getLoginForm()
    {
        if(Auth::guard('admin')->check())
        {
            return redirect('/');
        }
        Session::put('url.intended',\URL::previous());
        return view('authentication::admin.login');
    }

 public function authenticate()
    {
        $email = $this->request->input('username');
        $password = $this->request->input('password');
         
        if (auth()->guard('admin')->attempt(['email' => $email, 'password' => $password,'active'=> '1', 'email_verified' => '1'])) 
        {
            return redirect()->to(Session::get('url.intended'));
            //return redirect()->intended('/');
        }
        else
        {
            return redirect('login/coach')->with('message', 'Invalid Login Credentials !')->withInput();
        }
    }
    
    
    public function getLogout() 
    {
        auth()->guard('admin')->logout();
        //return redirect()->intended('login/coach');
        return redirect('/');
    }

    public function getProfile() 
    {
        $expertise = Expertise::all();
        $user = Auth::guard('admin')->user();
        return view('authentication::admin.profile',['expertise'=>$expertise,'user'=>$user]);
    }    
    public function postProfile() 
    {
        $login_input = $this->request->only('fname','lname','phone','password','confirm_password');
        $profile_input = $this->request->only('gender','dob','about','address','expert_in','social_link','tag_line');
        $profile_input['photo'] = $this->request->file('photo',NULL);
        $profile_input['cover_img'] = $this->request->file('cover_img',NULL);
        $custom_expertise = $this->request->only('custom_expertise');
        $val_input =array_merge(array_merge($login_input,$profile_input),$custom_expertise);
        $validator = Admins::validation_edit($val_input);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if( (count($profile_input['expert_in'])+count($custom_expertise['custom_expertise'])) >= 10 )
        {
            $validator->errors()->add('expert_in', 'You can have NINE experties only.');
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
        $admin = Auth::guard('admin')->user();
        $admin->update($login_input);
        $expert_in = $profile_input['expert_in'];
        unset($profile_input['expert_in']);
        $profile_input['dob'] = date('Y-m-d',strtotime($profile_input['dob']));
        if(isset($profile_input['photo']) && ($profile_input['photo']))
        {
        try
            {
                $imageFileName = "/profile/coach/".$admin->id."/".time() . '.' . $profile_input['photo']->getClientOriginalExtension();
                $s3 = \Storage::disk('s3');
                $s3->deleteDirectory(env('S3_ASSET_PATH','assets')."/profile/coach/".$admin->id);
                $s3->put(env('S3_ASSET_PATH','assets').$imageFileName, file_get_contents($profile_input['photo']), 'public');
                $profile_input['photo'] = $imageFileName;
            }
            catch (Exception $e)
            {
                //put default image
                if($profile_input['gender'] == 'M')
                {
                    $profile_input['photo'] = '/profile/coach/default_m.png';
                }
                else if($profile_input['gender'] == 'F')
                {
                    $profile_input['photo'] = '/profile/coach/default_f.png';
                }
                else
                {
                    $profile_input['photo'] = '/profile/coach/default.png';
                }
            }
        }
        else
        {
            unset($profile_input['photo']);
        }

        if(isset($profile_input['cover_img']) && ($profile_input['cover_img']))
        {
        try
            {
                $imageFileName = "/profile_cover/coach/".$admin->id."/".time() . '.' . $profile_input['cover_img']->getClientOriginalExtension();
                $s3 = \Storage::disk('s3');
                $s3->deleteDirectory(env('S3_ASSET_PATH','assets')."/profile_cover/coach/".$admin->id);
                $s3->put(env('S3_ASSET_PATH','assets').$imageFileName, file_get_contents($profile_input['cover_img']), 'public');
                $profile_input['cover_img'] = $imageFileName;
            }
            catch (Exception $e)
            {
                $profile_input['cover_img'] = '/profile_cover/coach/default.png';
                
            }
        }
        else
        {
             unset($profile_input['cover_img']);
        }

        $admin->profile->update($profile_input);
        $admin->expertise()->sync($expert_in);
        $admin->custom_expertise()->delete();
        if(count($custom_expertise['custom_expertise']))
        {
            foreach ($custom_expertise['custom_expertise'] as $value) {
                $CustomExpertise = new CustomExpertise(['title'=>$value]);
                $admin->custom_expertise()->save($CustomExpertise);
            }
        }
        return redirect('coach/myprofile')->with(['message'=>'Updated successfully!']);
    }
}
