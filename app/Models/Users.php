<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Users extends Authenticatable
{
	use SoftDeletes;
	protected $table = 'users';
    protected $fillable = ['fname','lname', 'email', 'password','phone','usertype','active','forgot_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function validation($inputArr)
    {

        $rules=[
                'fname' => 'required|max:64',
                'lname' => 'required|max:64',
                'phone'=>  'required|phone_number|unique:users,phone|unique:admins,phone',
                'email' => 'required|email|max:255|unique:users,email|unique:admins,email',
                'active' => 'in:0,1',
                'password' => 'required',
                'confirm_password' => 'same:password|required_with:password',
                'dob' => 'required|date',
                'gender' => 'required|in:M,F,O',
                'g-recaptcha-response' => 'required|recaptcha',
                ];


        $messages = array(
            'fname.required' => 'Please enter your First name',
            'lname.required' => 'Please enter your Last name',
            'email.required' => 'Please enter your email address',
            'phone.required' => 'Please enter a valid phone number',
            'active.required' => 'Please check user status',
            'dob.required' => 'Please enter your date of birth',
            'gender.required' => 'Please select a gender',
        );
        $validator = \Validator::make($inputArr, $rules, $messages);
        return $validator;
    }
    public static function validation_edit($inputArr)
    {
        $rules=[
                'fname' => 'required|max:64',
                'lname' => 'required|max:64',
                'phone'=>  'required|phone_number|unique:admins,phone|unique:users,phone,'.\Auth::guard('user')->id(),
                'active' => 'in:0,1',
                'password' => '',
                'confirm_password' => 'same:password|required_with:password',
                'dob' => 'required|date',
                'gender' => 'required|in:M,F,O',
                'about' => 'max:2000',
                'photo' => 'nullable|image|max:1000',
                ];


        $messages = array(
            'fname.required' => 'Please enter your First name',
            'lname.required' => 'Please enter your Last name',
            'email.required' => 'Please enter your email address',
            'phone.required' => 'Please enter a valid phone number',
            'active.required' => 'Please check user status',
            'dob.required' => 'Please enter your date of birth',
            'gender.required' => 'Please select a gender',
        );
        $validator = \Validator::make($inputArr, $rules, $messages);
        return $validator;
    }
    public function profile()
    {
        return $this->hasOne('App\Models\UsersProfile','user_id','id');
    }
    public function social()
    {
        return $this->hasMany('App\Models\Social','user_id','id');
    }
    public function subscribe()
    {
        return $this->hasOne('Dexel\User\Models\SubscribeModel','user_id','id');
    }
}
