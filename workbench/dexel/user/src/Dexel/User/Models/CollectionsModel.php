<?php

namespace Dexel\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CollectionsModel extends Model
{
    use SoftDeletes;
	protected $table = 'collections';
    protected $fillable = ['playlist_id','created_by'];
    public static function validation($inputArr)
    {
        $rules = array(
            'playlist_id' => 'required|exists:playlists,id',
            'action' => 'required|in:add,remove'
            );
        $validator = \Validator::make($inputArr, $rules, []);
        return $validator;
    }
    public function playlists()
    {
        return $this->belongsTo('\App\Models\Playlists','playlist_id','id');
    }
    public function createdby()
    {
        return $this->belongsTo('\App\Models\Admins','created_by','id');
    }
}