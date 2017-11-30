<?php namespace Dexel\Follow\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dexel\Follow\Facades\Follow;
use App\Models\Admins;
/**
 * The HomeController class.
 *
 * @package Dexel\Follow
 * @author  Manikandan R <mani@dexeldesigns.com>
 */
class HomeController extends Controller
{
    public function index($coach_id)
    {
    	$id = base64_decode($coach_id);
        $coach = Admins::where(['usertype'=>'coach','active'=>'1','id'=>$id])->first();
    	if($coach)
    	{
    		if(Follow::check_or_create($id))
    		{
    			$result['code']='success';
    			$result['action']=$coach_id."/remove";
				$result['text']='Unfollow';
    		}
    		else
    		{
    			$result['code']='validation';		
    		}
    	}
    	else
    	{
    		$result['code']='validation';
    	}
    	return response()->json($result);
    }
    public function remove($coach_id)
    {
    	$id = base64_decode($coach_id);

		if(Follow::remove($id))
		{
			$result['code']='success';
			$result['action']=$coach_id;
			$result['text']='Follow';
    	}
    	else
    	{
    		$result['code']='validation';
    	}
    	return response()->json($result);
    }
}
