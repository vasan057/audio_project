<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AdminsProfile extends Model
{
	use SoftDeletes;
	protected $table = 'admins_profile';
    protected $casts = ['address'=>'array','social_link'=>'array'];
    protected $fillable = [
        'photo','dob', 'about','address','gender','social_link','cover_img','tag_line','updated_by'
    ];
}
