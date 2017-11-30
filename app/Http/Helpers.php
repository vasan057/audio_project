<?php
function cdn($path,$type="image")
{
	if (filter_var($path, FILTER_VALIDATE_URL))
	{ 
		  return $path;
	}
	$cnd_url = url('/');
	$path=ltrim($path,'/');
	if($type == "image")
	{
		$cnd_url = env('CDN_URL',url('/')).'/'.env('S3_ASSET_PATH').'/'.$path;
	}
	return $cnd_url;
}
function api_response($code,$message,$model,$result,$header=200)
{
	$output = ['code'=>$code,'message'=>$message,'model'=>$model];
	if($header == 200)
	{
		$output['cdn'] = cdn('');
		$output['result'] = $result;
	}
	return response()->json($output,$header);
}
function jwt_userid()
{
	$payload = \JWTAuth::getPayload(\JWTAuth::getToken());
	if($payload['model'] == 'user')
	{
		return \Auth::user()->id;
	}
	else
	{
		return null;
	}
}
?>