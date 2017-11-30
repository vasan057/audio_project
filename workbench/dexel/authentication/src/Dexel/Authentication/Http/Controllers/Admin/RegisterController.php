<?php

namespace Dexel\Authentication\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Models\Admins;
use App\Models\AdminsProfile;
use App\Models\Expertise;
use App\Models\CustomExpertise;
use DB;
use App\Mail\CoachRegister;
use Mail;

class RegisterController extends Controller
{
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
        $expertise = Expertise::all();
        return view('authentication::admin.register',['expertise'=>$expertise]);
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
            $profile_input = $this->request->only('gender','dob','about','address','expert_in');
            $custom_expertise = $this->request->only('custom_expertise');
            $profile_input['photo'] = $this->request->file('photo');
            $val_input =array_merge(array_merge($login_input,$profile_input),$custom_expertise);
            $validator = Admins::validation($val_input);
            if ($validator->fails())
            {
                //dd($validator->messages());
                return redirect()->back()->withInput()->withErrors($validator);
            }
            if( (count($profile_input['expert_in'])+count($custom_expertise['custom_expertise'])) >= 10 )
            {
                $validator->errors()->add('expert_in', 'You can have NINE experties only.');
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $login_input['password'] = \Hash::make($login_input['password']);
            $login_input['forgot_token']=base64_encode($login_input['email'].date("YmdHis"));
            unset($login_input['confirm_password']);
            $login_input['active']='1';
            $admin = Admins::create($login_input);
            $expert_in = $profile_input['expert_in'];
            unset($profile_input['expert_in']);
            unset($login_input['g-recaptcha-response']);
            $profile_input['dob'] = date('Y-m-d',strtotime($profile_input['dob']));
            if(isset($profile_input['photo']) && ($profile_input['photo']))
            {
            try
                {
                    $imageFileName = "/profile/coach/".$admin->id."/".time() . '.' . $profile_input['photo']->getClientOriginalExtension();
                    $s3 = \Storage::disk('s3');
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
            $profile_input['cover_img'] = '/profile_cover/coach/default.png';
            $profile = new AdminsProfile($profile_input);
            $admin->profile()->save($profile);
            $admin->expertise()->sync($expert_in);
            if(count($custom_expertise['custom_expertise']))
            {
                foreach ($custom_expertise['custom_expertise'] as $value) {
                $CustomExpertise = new CustomExpertise(['title'=>$value]);
                $admin->custom_expertise()->save($CustomExpertise);
                }
            }
            if($admin->id){
                try
                {
                    Mail::to($admin->email)->send(new CoachRegister($admin));    
                }
                catch (\Exception $e)
                {
                    // mail failed 
                }
                
                return redirect('register/coach')->with('message', 'Thank You! Please check your email to activate your account');
            }else{
                return redirect('register/coach')->with('message', 'Registration failed, please try again.');
            }
        });
    }
    public function activateuser($token)
    {
        $record = Admins::where('forgot_token',$token)->where('email_verified','0')->first();
        if($record){
            //$record->active='1';
            $record->email_verified='1';
            $record->forgot_token=NULL;
            $record->save();
            return view('authentication::admin.activation');
        }
        else{
            return redirect('login/coach');
        }
    }
}
