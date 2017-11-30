<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Devices extends Authenticatable
{
	protected $table = 'devices';
    protected $fillable = ['type','password','created_by','updated_by'];
}
