<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScienceViews extends Model
{
	protected $table = 'science_views';
    protected $fillable = ['science_id','created_by'];
}
