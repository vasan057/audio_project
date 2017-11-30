<?php

Route::group(['middleware' => 'web'], function ()
{
//Route::get('audio', 'Dexel\Audio\Http\Controllers\HomeController@demo');
	Route::get('player/{playlist_id}/audio/{audio_id}','Dexel\Audio\Http\Controllers\HomeController@player')->where(['playlist_id'=>'[0-9]+','audio_id'=>'[0-9]+']);
	Route::get('playlist/{playlist_id}/audio/{audio_id}','Dexel\Audio\Http\Controllers\HomeController@get_audio')->where(['playlist_id'=>'[0-9]+','audio_id'=>'[0-9]+']);
	Route::get('playlist_details/{playlist_id}','Dexel\Audio\Http\Controllers\HomeController@get_rate_comment');
		Route::group(['middleware' => 'user'], function ()
		{
			Route::post('playlist/{slug}/rate/{audio_id}','Dexel\Audio\Http\Controllers\HomeController@set_rating');
			Route::post('playlist/{slug}/comment/{audio_id}','Dexel\Audio\Http\Controllers\HomeController@post_comment');
		});
});


//API
Route::group(['prefix'=>'api/v1','middleware' => 'only_api'], function ()
{
	Route::group(['middleware' => 'devicejwt'], function ()
	{
		Route::get('playlist/categories','Dexel\Audio\Http\Controllers\Api\HomeController@get_categories');
		Route::get('playlists/{category?}','Dexel\Audio\Http\Controllers\Api\HomeController@get_playlist');
		Route::get('playlist/{playlist_id}/audio/{audio_id}','Dexel\Audio\Http\Controllers\Api\HomeController@get_audio')->where(['playlist_id'=>'[0-9]+','audio_id'=>'[0-9]+']);
		Route::get('playlist_details/{playlist_id}','Dexel\Audio\Http\Controllers\Api\HomeController@get_rate_comment');
	});
	Route::group(['middleware' => 'userjwt'], function ()
	{
		Route::post('playlist/{slug}/rate/{audio_id}','Dexel\Audio\Http\Controllers\Api\HomeController@set_rating');
		Route::post('playlist/{slug}/comment/{audio_id}','Dexel\Audio\Http\Controllers\Api\HomeController@post_comment');
	});
});