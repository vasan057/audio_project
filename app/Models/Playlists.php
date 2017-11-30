<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Playlists extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'playlists';
    protected $casts = ['author_detail'=>'array'];
    protected $fillable = ['name','slug','description','category_id','active','author','author_detail','created_by','updated_by'];
    public static function validation($input)
    {
        $rules = [
        "name"=>'required|max:64',
        'slug' => 'required|max:64|unique:playlists,slug',
        "description"=>'required|max:1000',
        'category' => 'required|exists:playlist_category,id',
        'author' => 'nullable|exists:admins,id',
        'author_detail.name' => 'nullable|max:64',
        'author_detail.photo' => 'nullable|image|max:1000',
        'image' => 'required|image|max:1000',
        ];
        $message = [
        "name.required"=>'Please fill title',
        'slug.unique'=>"The name has already been taken",
        "description.required"=>'Please fill description',
        'category.required' => 'Please select essense'
        ];

        $validator = \Validator::make($input, $rules, $message);
        return $validator;
    }
    public static function edit_validation($input,$playlist_id)
    {
        $rules = [
        "name"=>'required|max:64',
        'slug' => 'required|max:64|unique:playlists,slug,'.$playlist_id,
        "description"=>'required|max:1000',
        'category' => 'required|exists:playlist_category,id',
        'image' => 'nullable|image|max:1000',
        'author' => 'nullable|exists:admins,id',
        'author_detail.name' => 'nullable|max:64',
        'author_detail.photo' => 'nullable|image|max:1000',
        ];
        $message = [
        "name.required"=>'Please fill title',
        'slug.unique'=>"The name has already been taken",
        "description.required"=>'Please fill description',
        'category.required' => 'Please select essense'
        ];

        $validator = \Validator::make($input, $rules, $message);
        return $validator;
    }
    public function audios()
    {
        return $this->hasMany('\App\Models\Audios','playlist_id','id');
    }
    public function category()
    {
        return $this->belongsTo('\App\Models\PlaylistCategory','category_id','id');
    }
    public function createdby()
    {
        return $this->belongsTo('\App\Models\Admins','created_by','id');
    }
    public function updatedby()
    {
        return $this->belongsTo('\App\Models\Admins','updated_by','id');
    }
    public function custom_author()
    {
        return $this->belongsTo('\App\Models\Admins','author','id');
    }
    public function collections()
    {
        return $this->hasMany('\Dexel\User\Models\CollectionsModel','playlist_id','id');
    }
    public function mycollections()
    {

        return $this->collections()->where(['created_by'=>\Auth::guard('user')->id()]);
    }
    protected static function boot()
    {
        parent::boot();
        static::deleting(function($playlists)
        {
             $playlists->audios()->delete();
        });
    }
}
