<?php

namespace Dexel\Contact\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ContactModel extends Model
{
    use SoftDeletes;
	protected $table = 'contact';
    protected $fillable = ['fname','lname','email','phone', 'message','created_by'];
    public static function validation($inputArr,$recaptcha='yes')
    {
        $rules=[
                'fname' => 'required|max:64',
                'lname' => 'required|max:64',
                'email' => 'required|email|max:255',
                'phone'	=>  'required|phone_number',               
                'message' => 'required|max:20000'
                ];
            if($recaptcha != 'no')
            {
                $rules['g-recaptcha-response'] = 'required|recaptcha';
            }
         $messages = [
            'fname.required' => 'Please enter first name',
            'lname.required' => 'Please enter last name'
        ];
        $validator = \Validator::make($inputArr, $rules, $messages);
        return $validator;
    }	
}