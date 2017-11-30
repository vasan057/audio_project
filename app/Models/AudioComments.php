<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class AudioComments extends Model
{
    protected $table = 'audio_comments';
    protected $fillable = ['rating_id','audio_id','comment','created_by'];
    public static function validation($input)
    {
        $rules = [
        //'slug' => 'required|exists:playlists,slug',
        "comment"=>'required|max:1000'
        ];
        $validator = \Validator::make($input, $rules, []);
        return $validator;
    }
    public function createdby()
    {
        return $this->belongsTo('\App\Models\Users','created_by','id');
    }
    public function audio()
    {
        return $this->belongsTo('\App\Models\Audios','audio_id','id');
    }
}
