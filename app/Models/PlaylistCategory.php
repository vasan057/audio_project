<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PlaylistCategory extends Model
{
	use SoftDeletes;
	protected $table = 'playlist_category';
    protected $fillable = ['title','active','icon','created_by','updated_by'];
    public static function validation($input)
    {
        $rules = [
        "title"=>'required|max:64',
        "icon"=>'required|in:1,2,3,4,5,6,7,8,9,101,102,103,104,105,106,107,108,109',
        ];
        $validator = \Validator::make($input, $rules, []);
        return $validator;
    }

	public function playlists()
    {
        return $this->hasMany('\App\Models\Playlists','category_id','id');
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
