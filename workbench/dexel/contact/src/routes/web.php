<?php

Route::group(['prefix' => 'contact','middleware'=>'web'], function() {
	Route::group(['middleware'=>'guest'], function() {
	    Route::get('/', 'Dexel\Contact\Http\Controllers\HomeController@index');
	    Route::post('/', 'Dexel\Contact\Http\Controllers\HomeController@store');
	    //Route::get('my-test-mail','Dexel\Contact\Http\Controllers\HomeController@myTestMail');
	});
});
//API
Route::group(['prefix'=>'api/v1','middleware' => 'only_api'], function ()
{
	Route::group(['middleware' => 'devicejwt'], function ()
	{
		Route::post('contact', 'Dexel\Contact\Http\Controllers\Api\HomeController@store');
	});
});