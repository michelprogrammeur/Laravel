<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'FrontController@index');

Route::get('prod/{id}/{slug?}', 'FrontController@show');

Route::get('cat/{id}/{slug?}', 'FrontController@showProductByCategory');


Route::pattern('id', '[1-9][0-9]*');
Route::pattern('slug', '[a-z0-9-\_]+');

//users 

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('contact', 'FrontController@showContact');
	Route::post('send', 'FrontController@sendContact');
	
	Route::group(['middleware' => ['auth']], function () {
		Route::any('login', 'LoginController@login'); // get et post
		Route::get('dashboard', 'FrontController@dashboard');

		Route::resource('product','ProductController');
	});
});
