<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sciences extends Model
{
	use SoftDeletes;
	protected $table = 'sciences';
    protected $fillable = ['title','slug','short_description','description','cover_img','created_by','updated_by'];

    public static function validation($inputArr)
    {

        $rules=[
                'title' => 'required|max:64',
                //'slug' => 'required|max:64|unique:articles,slug',
                'short_description'=>'required|max:254',
                'description' => 'required|max: 16777210',
                'cover_img' => 'nullable|image|max:1000',
                ];

        $messages = ['slug.required'=>'','slug.unique'=>"The title has already been taken"];
        $validator = \Validator::make($inputArr, $rules, $messages);
        return $validator;
    }
    public function category()
    {
        return $this->belongsTo('App\Models\ScienceCategory','category_id','id');
    }
    public function views()
    {
        return $this->hasMany('App\Models\ScienceViews','science_id','id');
    }
    public function createdby()
    {
        return $this->belongsTo('\App\Models\Admins','created_by','id');
    }
    public function updatedby()
    {
        return $this->belongsTo('\App\Models\Admins','updated_by','id');
    }
		
}
