<?php
Route::group(['middleware' => 'web'], function ()
{
	Route::group(['prefix'=>'coach','middleware' => 'coach'], function ()
	{
		Route::get('/', 'Dexel\Admin\Http\Controllers\HomeController@index');
		Route::get('uploads', 'Dexel\Admin\Http\Controllers\HomeController@uploads');

		//article
		/*Route::get('upload/articles', 'Dexel\Admin\Http\Controllers\ArticleController@index');
		Route::post('upload/article', 'Dexel\Admin\Http\Controllers\ArticleController@store');
		Route::get('view/article/{slug}', 'Dexel\Admin\Http\Controllers\ArticleController@view');
		Route::get('remove/article/{slug}', 'Dexel\Admin\Http\Controllers\ArticleController@remove');*/
		//Route::get('get/article/{slug}', 'Dexel\Admin\Http\Controllers\ArticleController@get');

		//video
		/*Route::get('upload/videos', 'Dexel\Admin\Http\Controllers\VideoController@index');
		Route::post('upload/video', 'Dexel\Admin\Http\Controllers\VideoController@store');

		Route::get('view/video/{slug}', 'Dexel\Admin\Http\Controllers\VideoController@view');
		Route::get('remove/video/{slug}', 'Dexel\Admin\Http\Controllers\VideoController@remove');
		Route::get('get/video/{slug}', 'Dexel\Admin\Http\Controllers\VideoController@get');*/

		//audio
		Route::get('upload/audios', 'Dexel\Admin\Http\Controllers\AudioController@index');
		Route::get('thisweek/audios', 'Dexel\Admin\Http\Controllers\AudioController@audio_week');
		Route::get('audios/searchsongs',[
			'as' 	=> 'searchsongs',
			'uses'	=> 'Dexel\Admin\Http\Controllers\AudioController@searchsongs'
		]);
		/*Add song*/
		Route::any('audios/this_weekinsert',[
			'as'	=> 'add_weeksong',
			'uses'  => 'Dexel\Admin\Http\Controllers\AudioController@add_weeksong'
		]);

		/*Delete*/
		Route::any('deletelist/{id}',[
			'as'	=> 'deletelist',
			'uses'  => 'Dexel\Admin\Http\Controllers\AudioController@deletelist'
		]);

		/*Active Inactive */
		Route::any('activelist/{id}',[
			'as'    => 'activelist',
			'uses'  => 'Dexel\Admin\Http\Controllers\AudioController@activelist'
		]);
		Route::get('upload/audios/{category_id}', 'Dexel\Admin\Http\Controllers\AudioController@index')->where(['category_id'=>'[0-9]+']);
		Route::get('upload/audio/new', 'Dexel\Admin\Http\Controllers\AudioController@get');
		Route::post('upload/audio/new', 'Dexel\Admin\Http\Controllers\AudioController@store');
		Route::get('upload/audio/{playlis_id}/delete', 'Dexel\Admin\Http\Controllers\AudioController@deletePlayist');
		Route::get('upload/audios/jobs', 'Dexel\Admin\Http\Controllers\AudioController@jobStatus');
		Route::get('upload/audio/{slug}/edit', 'Dexel\Admin\Http\Controllers\AudioController@edit');
		Route::post('upload/audio/{slug}/edit', 'Dexel\Admin\Http\Controllers\AudioController@editStore');
		Route::get('remove/playlist/{slug}', 'Dexel\Admin\Http\Controllers\AudioController@deletePlayist');

		//profile
		Route::get('profile','Dexel\Admin\Http\Controllers\HomeController@profile');

		Route::post('getS3PreSignedUrl','Dexel\Admin\Http\Controllers\AwsController@index');

		/*caoch can view of list of folowers and block/unblock if needed 
		will be user later*/
		
		/*Route::get('followers', 'Dexel\Admin\Http\Controllers\FollowController@index');
		Route::post('followers/unblock/{followId}', 'Dexel\Admin\Http\Controllers\FollowController@unblock');
		Route::post('followers/block/{followId}', 'Dexel\Admin\Http\Controllers\FollowController@block');*/

		Route::get('audios/my_category/{id?}','Dexel\Admin\Http\Controllers\AudioController@get_my_category');
		Route::post('audios/my_category/{id?}','Dexel\Admin\Http\Controllers\AudioController@add_my_category');

		Route::post('my_category/deactivate/{id?}','Dexel\Admin\Http\Controllers\AudioController@deactivate_category');
		Route::post('my_category/activate/{id?}','Dexel\Admin\Http\Controllers\AudioController@activate_category');

		Route::group(['middleware' => 'admin'], function ()
		{
			Route::get('sciences', 'Dexel\Admin\Http\Controllers\ScienceController@index');
			Route::get('science/{slug}', 'Dexel\Admin\Http\Controllers\ScienceController@get');
			Route::get('science/{slug}/json', 'Dexel\Admin\Http\Controllers\ScienceController@get_description');
			Route::post('science/{slug}', 'Dexel\Admin\Http\Controllers\ScienceController@store');
			Route::get('view/science/{slug}', 'Dexel\Admin\Http\Controllers\ScienceController@view');

			Route::get('quotes', 'Dexel\Admin\Http\Controllers\QuotesController@index');
			Route::get('quote/new', 'Dexel\Admin\Http\Controllers\QuotesController@get');
			Route::post('quote/new', 'Dexel\Admin\Http\Controllers\QuotesController@store');
			Route::get('quote/{id}', 'Dexel\Admin\Http\Controllers\QuotesController@edit')->where(['id'=>'[0-9]+']);
			Route::post('quote/{id}', 'Dexel\Admin\Http\Controllers\QuotesController@store')->where(['id'=>'[0-9]+']);
			Route::get('view/quote/{id}', 'Dexel\Admin\Http\Controllers\QuotesController@view');
			Route::get('remove/quote/{id}', 'Dexel\Admin\Http\Controllers\QuotesController@deleteQuote');

			Route::get('messages', 'Dexel\Admin\Http\Controllers\ContactController@index');

			Route::get('all', 'Dexel\Admin\Http\Controllers\CoachController@index');
			Route::get('find', 'Dexel\Admin\Http\Controllers\CoachController@find_coach');

			Route::post('activate/{coach}', 'Dexel\Admin\Http\Controllers\CoachController@activate');
			Route::post('deactivate/{coach}', 'Dexel\Admin\Http\Controllers\CoachController@deactivate');

			Route::get('users/all', 'Dexel\Admin\Http\Controllers\UsersController@index');
			Route::post('user/activate/{coach}', 'Dexel\Admin\Http\Controllers\UsersController@activate');
			Route::post('user/deactivate/{coach}', 'Dexel\Admin\Http\Controllers\UsersController@deactivate');

			Route::get('profile/{coach}','Dexel\Admin\Http\Controllers\CoachController@profile');
			
			Route::get('upload/{coach}/audios', 'Dexel\Admin\Http\Controllers\CoachController@index');

			Route::get('{coach}/upload/audios', 'Dexel\Admin\Http\Controllers\CoachController@audios');
			Route::get('{coach}/upload/audios/{category_id}', 'Dexel\Admin\Http\Controllers\CoachController@audios')->where(['category_id'=>'[0-9]+']);
			
			Route::get('{coach}/upload/audios/jobs', 'Dexel\Admin\Http\Controllers\CoachController@jobStatus');
			Route::get('{coach}/upload/audio/{slug}/edit', 'Dexel\Admin\Http\Controllers\CoachController@edit_audio');
			Route::post('{coach}/upload/audio/{slug}/edit', 'Dexel\Admin\Http\Controllers\CoachController@editStore_audio');
			Route::get('{coach}/remove/playlist/{slug}', 'Dexel\Admin\Http\Controllers\CoachController@deletePlayist');
			Route::post('{coach}/action/playlist/{slug}', 'Dexel\Admin\Http\Controllers\CoachController@playistAction');

			Route::get('subscribe', 'Dexel\Admin\Http\Controllers\NewsletterController@index');
			Route::post('subscribe', 'Dexel\Admin\Http\Controllers\NewsletterController@newsletter');
			Route::get('subscribe/list', 'Dexel\Admin\Http\Controllers\NewsletterController@subscribe_list');
			Route::get('subscribe/remove/{id}', 'Dexel\Admin\Http\Controllers\NewsletterController@subscribe_remove');
			Route::get('find/user', 'Dexel\Admin\Http\Controllers\NewsletterController@find_user');

			Route::post('newsletter/preview', 'Dexel\Admin\Http\Controllers\NewsletterController@preview');

			Route::get('mailto', 'Dexel\Admin\Http\Controllers\HomeController@mailto');
			Route::post('mailto', 'Dexel\Admin\Http\Controllers\HomeController@send_mailto');
			Route::post('mailto/preview', 'Dexel\Admin\Http\Controllers\HomeController@mailto_preview');
		});
	});
});
