<?php namespace Dexel\Follow\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The FollowModel class.
 *
 * @package Dexel\Follow
 * @author  Manikandan R <mani@dexeldesigns.com>
 */
class FollowModel extends Model
{
    use SoftDeletes;
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'follows';

    /**
    * The attributes that are mass assignable.
    *
    * @var mixed
    */
    protected $fillable = ['blocked','coach_id','created_by'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function createdby()
    {
        return $this->belongsTo('\App\Models\Users','created_by','id');
    }
}
