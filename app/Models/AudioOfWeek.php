<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AudioOfWeek extends Model
{
    protected $table ='audio_of_weeks';
    protected $fillable = ['playlist_id','active','created_by','updated_by'];

    /*validation*/
    public static function validation($input)
    {
    	$rules= [
    			  'song_id'    => 'required',
                  'playlist_id' => 'required|unique:audio_of_weeks,playlist_id'
                ];
        $message = [
	        		"song_id.required"=>'Please fill Song',
	        		"playlist_id.required"=>'Please Use diffent song',
        		];
        $validator = \Validator::make($input, $rules, $message);
        return $validator;
    }
    public function playlists(){

        return $this->hasMany('\App\Models\Playlists','id','playlist_id');   
        
    }
}
