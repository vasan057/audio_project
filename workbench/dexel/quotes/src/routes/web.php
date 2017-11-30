<?php
Route::group(['middleware' => 'only_api'], function ()
{
	Route::group(['prefix'=>'api/v1','middleware' => 'devicejwt'], function ()
	{
		Route::get('quotes', 'Dexel\Quotes\Http\Controllers\Api\HomeController@index');
	});
});