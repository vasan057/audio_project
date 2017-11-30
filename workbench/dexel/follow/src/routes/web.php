<?php

Route::group(['prefix' => 'follow','middleware' => 'web'], function()
{
	Route::group(['middleware' => 'user'], function()
		{
			Route::post('/{coach}', 'Dexel\Follow\Http\Controllers\HomeController@index');
    		Route::post('/{coach}/remove', 'Dexel\Follow\Http\Controllers\HomeController@remove');
		});
});