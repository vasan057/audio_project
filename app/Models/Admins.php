<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admins extends Authenticatable
{
	use SoftDeletes;
	protected $table = 'admins';
    protected $fillable = ['fname','lname', 'email', 'password','phone','usertype','active','forgot_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function followers()
    {
        return $this->hasMany('\Dexel\Follow\Models\FollowModel', 'coach_id');
    }

    public function expertise()
    {
    	return $this->belongsToMany('\App\Models\Expertise', 'coach_expertise','created_by', 'expertise_id');
    }
    public function custom_expertise()
    {
        return $this->hasMany('\App\Models\CustomExpertise','created_by', 'id');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\AdminsProfile','admin_id','id');
    }

    public static function validation($inputArr)
    {

        $rules=[
                'fname' => 'required|max:64',
                'lname' => 'required|max:64',
                'phone'=>  'required|phone_number|unique:users,phone|unique:admins,phone',
                'email' => 'required|email|max:255|unique:users,email|unique:admins,email',
                //'usertype' => 'required|in:A,M',
                //'custom_expertise' =>'regex:"/^[a-zA-Z\,]$/"',
                'active' => 'in:0,1',
                'password' => 'required',
                'confirm_password' => 'same:password|required_with:password',
                'photo' => 'nullable|image|max:1000',
                'cover_img' => 'nullable|image|max:2000',
                'dob' => 'required|date',
                'gender' => 'required|in:M,F,O',
                'expert_in' => 'required|exists:expertise,id',
                'about' => 'required|max:2000',
                //'address.street' => 'required',
                //'address.suburb' => 'required',
                'g-recaptcha-response' => 'required|recaptcha',
                ];
        $nbr = count($inputArr['custom_expertise'])-1;
        foreach(range(0, $nbr) as $index)
        {
            $rules['custom_expertise.'.$index] = 'alpha_spaces|max:20';
            //$message['custom_expertise.'.$index.'.required'] = 'Please fill audio title';
        }

        $messages = array(
            'fname.required' => 'Please enter your First name',
            'lname.required' => 'Please enter your Last name',
            'email.required' => 'Please enter your email address',
            'phone.required' => 'Please enter a valid phone number',
            'active.required' => 'Please check user status',
            'photo.required' => 'Please upload your profile picture',
            'dob.required' => 'Please enter your date of birth',
            'gender.required' => 'Please select a gender',
            'expert_in.required' => 'Please select a expertise',
            //'address.street.required' => 'The address field is required.',
            //'address.suburb.required' => 'The suburb field is required.',
            /*'password.required_with' => 'Please enter password',
            'confirm_password.required_with' => 'Please enter confirm password'            */
        );
        $validator = \Validator::make($inputArr, $rules, $messages);
        return $validator;
    }
    public static function validation_edit($inputArr)
    {

        $rules=[
                'fname' => 'required|max:64',
                'lname' => 'required|max:64',
                'phone'=>  'required|phone_number|unique:users,phone|unique:admins,phone,'.\Auth::guard('admin')->id(),
                //'usertype' => 'required|in:A,M',
                'active' => 'in:0,1',
                'password' => '',
                'confirm_password' => 'same:password',
                'photo' => 'nullable|image|max:1000',
                'cover_img' => 'nullable|image|max:2000',
                'tag_line' => 'max:64',
                'dob' => 'required|date',
                'gender' => 'required|in:M,F,O',
                'expert_in' => 'required|exists:expertise,id',
                'about' => 'required|max:2000'
                ];
        $nbr = count($inputArr['custom_expertise'])-1;
        foreach(range(0, $nbr) as $index)
        {
            $rules['custom_expertise.'.$index] = 'alpha_spaces|max:20';
            //$message['custom_expertise.'.$index.'.required'] = 'Please fill audio title';
        }

        $messages = array(
            'fname.required' => 'Please enter first name',
            'lname.required' => 'Please enter last name',
            'phone.required' => 'Please enter phone number',
            'active.required' => 'Please check user status',
            'photo.required' => 'Please upload your profile picture',
            'dob.required' => 'Please enter your data birth',
            'gender.required' => 'Please select a gender',
            'expert_in.required' => 'Please select atlease one avaible expertise'
        );
        $validator = \Validator::make($inputArr, $rules, $messages);
        return $validator;
    }
}
