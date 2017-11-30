<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Quotes extends Model
{
	use SoftDeletes;
	protected $table = 'quotes';
    protected $fillable = ['active','description','cover_img','created_by','updated_by'];

    public static function validation($inputArr)
    {

        $rules=[
                'active' => 'in:0,1',
                'author'=>'required|max:64',
                'description'=>'required|max:254',
                'cover_img' => 'nullable|image|max:1000',
                ];
        $messages=[];
        $validator = \Validator::make($inputArr, $rules, $messages);
        return $validator;
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
