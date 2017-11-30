<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'web'], function ()
{
	Route::group(['middleware' => 'guest'], function ()
	{
		Route::get('/', 'HomeController@index');
	
		Route::get('articles', 'ArticleController@index');
		Route::get('article/{id?}', 'ArticleController@detail');
		Route::get('articles/{category_id?}', 'ArticleController@category');

		Route::get('videos', 'VideoController@index');
		Route::get('video/{id?}', 'VideoController@detail');
		Route::get('videos/{category_id?}', 'VideoController@category');

		Route::get('audios/{category_title?}', 'AudioController@index');
		Route::get('audios/{slug}/rate_and_comment', 'AudioController@rate_and_comment');

		Route::get('coaches', 'CoachController@index');
		Route::get('coache/{id}', 'CoachController@coachprofile');
		Route::get('coache/{id}/audios/{category_title?}', 'CoachController@audios');

		Route::get('contactus', 'HomeController@contactus');
	});
});


//API
Route::group(['middleware' => 'only_api'], function ()
{
	Route::group(['prefix'=>'api/v1','middleware' => 'devicejwt'], function ()
	{
		Route::get('coaches','Api\CoachController@index');
		Route::get('coache/{id}', 'Api\CoachController@coachprofile');
		Route::get('coache/{id}/playlists/{category_title?}', 'Api\CoachController@audios');
	});
});