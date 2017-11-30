<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CustomExpertise extends Model
{
    protected $table = 'coach_custom_expertise';
    protected $fillable = ['title','created_by'];
}
