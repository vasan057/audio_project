<?php

namespace Dexel\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SubscribeModel extends Model
{
    use SoftDeletes;
	protected $table = 'subscribe';
    protected $fillable = ['user_id','email','name'];
    public static function validation($inputArr,$recaptcha='yes')
    {
        $rules = array(
            'email' => 'required|email',
            'name' => 'required',
            );
            if($recaptcha != 'no')
            {
                $rules['g-recaptcha-response'] = 'required|recaptcha';
            }
        $validator = \Validator::make($inputArr, $rules, []);
        return $validator;
    }
    public function user()
    {
        return $this->belongsTo('\App\Models\Users','user_id','id');
    }
}