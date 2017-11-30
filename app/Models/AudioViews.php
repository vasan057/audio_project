<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AudioViews extends Model
{

	protected $table = 'audio_views';
    protected $fillable = ['audio_id','created_by'];
    public function audio()
    {
        return $this->belongsTo('\App\Models\Audios','audio_id','id');
    }
}
