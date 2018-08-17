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

Auth::routes();

// applying a middle ware for index in controller
Route::group(['middleware' => ['auth']], function()
{
	Route::get('/', 'TimelineController@index');
	// for the post request of axios in App.js
	Route::post('/posts', 'PostController@create');

	// For profile showing, passing user parameter
	Route::get('/users/{user}', 'UserController@index');

	//follow another user
	Route::get('/users/{user}/follow', 'UserController@follow')->name('users.follow');

	// unfollow user actually followed
	Route::get('/users/{user}/unfollow', 'UserController@unfollow')->name('users.unfollow');
});