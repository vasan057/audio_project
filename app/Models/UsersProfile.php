<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UsersProfile extends Model
{
	use SoftDeletes;
	protected $table = 'users_profile';
    protected $casts = ['address'=>'array'];
    protected $fillable = [
        'photo','dob', 'about','address','gender','updated_by'
    ];
}
