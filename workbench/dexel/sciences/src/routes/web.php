<?php
Route::group(['prefix' => 'science','middleware' => 'web'], function()
{
	Route::group(['middleware' => 'guest'], function ()
	{
		Route::get('{category_slug?}', 'Dexel\Sciences\Http\Controllers\HomeController@index');
	});
});


//API
Route::group(['middleware' => 'only_api'], function ()
{
	Route::group(['prefix'=>'api/v1','middleware' => 'devicejwt'], function ()
	{
		Route::get('science/categories', 'Dexel\Sciences\Http\Controllers\Api\HomeController@categories');
		Route::get('science/category/{category_slug?}', 'Dexel\Sciences\Http\Controllers\Api\HomeController@index');
	});
});