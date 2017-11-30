<?php
Route::group(['middleware' => 'web'], function ()
{

	Route::get('subscribe', 'Dexel\User\Http\Controllers\SubscribeController@index');
	Route::post('subscribe', 'Dexel\User\Http\Controllers\SubscribeController@store');
	Route::group(['middleware' => 'user'], function ()
	{
		Route::get('dashboard', 'Dexel\User\Http\Controllers\HomeController@index');
		Route::get('collections', 'Dexel\User\Http\Controllers\CollectionsController@index');
		Route::post('collection', 'Dexel\User\Http\Controllers\CollectionsController@store');
		Route::get('profile', 'Dexel\User\Http\Controllers\HomeController@profile');
		Route::get('transactions', 'Dexel\User\Http\Controllers\HomeController@credit');

		Route::post('subscribe/{action}', 'Dexel\User\Http\Controllers\SubscribeController@storeAction');
	});
});
//API
Route::group(['prefix'=>'api/v1','middleware' => 'only_api'], function ()
{
	Route::group(['middleware' => 'userjwt'], function ()
	{
		Route::get('collections', 'Dexel\User\Http\Controllers\Api\CollectionsController@index');
		Route::post('collection', 'Dexel\User\Http\Controllers\Api\CollectionsController@store');
	});
	Route::group(['middleware' => 'devicejwt'], function ()
	{
		Route::post('subscribe', 'Dexel\User\Http\Controllers\Api\SubscribeController@store');
		Route::post('unsubscribe', 'Dexel\User\Http\Controllers\SubscribeController@unsubscribe');
	});
});
