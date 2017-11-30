<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class AudioRatings extends Model
{
    protected $table = 'audio_ratings';
    protected $fillable = ['audio_id','rate','created_by'];
    public static function validation($input)
    {
        $rules = [
        'slug' => 'required|exists:playlists,slug',
        "rate"=>'required|in:1,2,3,4,5'
        ];
        $validator = \Validator::make($input, $rules, $message);
        return $validator;
    }
    public function createdby()
    {
        return $this->belongsTo('\App\Models\Users','created_by','id');
    }
    public function comment()
    {
        return $this->hasOne('\App\Models\AudioComments','rating_id','id');
    }
}
