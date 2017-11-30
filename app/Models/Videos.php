<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Videos extends Model
{
	use SoftDeletes;
	protected $table = 'videos';
    protected $fillable = ['title','slug','active', 'approved', 'short_description','description','video_url','author','isfree','recommended','category_id','essence_id','cover_img','created_by','updated_by'];

    public static function validation($inputArr)
    {

        $rules=[
                'title' => 'required|max:64',
                'slug' => 'required|max:64|unique:videos,slug',
                'active' => 'in:0,1',
                'isfree' => 'in:0,1',
                'recommended' => 'in:0,1',
                'short_description'=>'required|max:254',
                'description' => 'required|max:65500',
                'video_url' => 'required|max:254',
                'author' => 'max:64',
                'category' => 'required|exists:video_category,id',
                'essence' => 'required|exists:video_essence,id',
                'cover_img' => 'required|image|max:1000',
                ];

        $messages = ['slug.required'=>'','slug.unique'=>"The title has already been taken"];
        $validator = \Validator::make($inputArr, $rules, $messages);
        return $validator;
    }
    public function category()
    {
        return $this->belongsTo('App\Models\VideoCategory','category_id','id');
    }
    public function essence()
    {
        return $this->belongsTo('App\Models\VideoEssence','essence_id','id');
    }
    public function views()
    {
        return $this->hasMany('App\Models\VideoViews','video_id','id');
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
