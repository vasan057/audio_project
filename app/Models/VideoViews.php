<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoViews extends Model
{

	protected $table = 'video_views';
    protected $fillable = ['video_id','created_by'];
}
