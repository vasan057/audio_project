<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ScienceCategory extends Model
{
	use SoftDeletes;
    protected $table = 'science_category';

    public function science()
    {
        return $this->hasOne('App\Models\Sciences','category_id','id');
    }
}
