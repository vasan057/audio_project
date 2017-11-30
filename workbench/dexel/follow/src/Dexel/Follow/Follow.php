<?php namespace Dexel\Follow;
use Dexel\Follow\Models\FollowModel;
use Auth;
/**
 * The Follow class.
 *
 * @package Dexel\Follow
 * @author  Manikandan R <mani@dexeldesigns.com>
 */
class Follow
{
    public function check_or_create($coach_id)
    {
        $follow = FollowModel::withTrashed()->where(['created_by'=>Auth::guard('user')->id(),'coach_id'=>$coach_id])->first();
        if($follow)
        {
        	$follow->deleted_at = NULL;
        	$follow->save();
        }
        else
        {
        	$follow = FollowModel::create(['created_by'=>Auth::guard('user')->id(),'coach_id'=>$coach_id]);
        }
        return $follow;
    }
    public function remove($coach_id)
    {
        $follow = FollowModel::where(['blocked'=>'0','created_by'=>Auth::guard('user')->id(),'coach_id'=>$coach_id])->first();
        if($follow)
        {
        	$follow->delete();
        }
       	return $follow;
    }
}
