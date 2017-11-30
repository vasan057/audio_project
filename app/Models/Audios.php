<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Audios extends Model
{
	use SoftDeletes;
	protected $table = 'audios';
    protected $fillable = ['name','path','playlist_id','description','active','created_by','updated_by'];
    public static function validation($input)
    {
        //100000 100 Mb
        $nbr = count($input['audio'])-1;
        foreach(range(0, $nbr) as $index)
        {
            $rules['audio_name.'.$index] = 'required|max:256';
            $rules['audio_description.'.$index] = 'required|max:1000';
            $rules['audio.'.$index] = 'audio:mp3,wav,ogg|required|max:250000';

            $message['audio_name.'.$index.'.required'] = 'Please fill audio title';
            $message['audio_description.'.$index.'.required'] = 'Please fill audio description';
            $message['audio.'.$index.'.required'] ='Please select audio file';
            $message['audio.'.$index.'.audio'] ='Please upload mp3 file';
        }
        $validator = \Validator::make($input, $rules, $message);
        return $validator;
    }
    public static function edit_validation($input)
    {
        //100000 100 Mb
        $nbr = count($input['audio_name'])-1;
        foreach(range(0, $nbr) as $index)
        {
            $rules['audio_name.'.$index] = 'required|max:256';
            $rules['audio_description.'.$index] = 'required|max:1000';
            $rules['audio.'.$index] = 'audio:mp3,wav,ogg|max:250000';

            $message['audio_name.'.$index.'.required'] = 'Please fill audio title';
            $message['audio_description.'.$index.'.required'] = 'Please fill audio description';
            $message['audio.'.$index.'.audio'] ='Please upload mp3 file';
        }
        $validator = \Validator::make($input, $rules, $message);
        return $validator;
    }
    public function views()
    {
        return $this->hasMany('App\Models\AudioViews','audio_id','id');
    }
    public function playlist()
    {
        return $this->belongsTo('App\Models\Playlists','playlist_id','id');
    }
    public function audio_of_week()
    {
        return $this->hasMany('App\Models\AudioOfWeek','audio_id','id');
    }
    public function createdby()
    {
        return $this->belongsTo('\App\Models\Admins','created_by','id');
    }
    public function updatedby()
    {
        return $this->belongsTo('\App\Models\Admins','updated_by','id');
    }
    public function ratings()
    {
        return $this->hasMany('\App\Models\AudioRatings','audio_id','id');
    }
    public function my_rating()
    {
        return $this->ratings()->where('created_by',\Auth::guard('user')->id());
    }
    public function comments()
    {
        return $this->hasMany('\App\Models\AudioComments','audio_id','id');
    }
    public function my_comment()
    {
        return $this->comments()->where('created_by',\Auth::guard('user')->id());
    }
}
