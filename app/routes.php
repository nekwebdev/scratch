<?php

/** ------------------------------------------
 *  Interface repository binding
 *  ------------------------------------------
 */
App::bind('UserRepositoryInterface', 'EloquentUserRepository');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route group for API versioning
Route::group(array('prefix' => 'api/v1'), function()
{
    Route::resource('user', 'api\v1\UserController');
});

// Confide front end user controller routes
Route::group(array('prefix' => 'user'), function()
{
    Route::get('confirm/{code}', 'frontend\UserController@getConfirm');
	Route::get('reset/{token}', 'frontend\UserController@getReset');
	Route::controller( '/', 'frontend\UserController');
});


// Home page routes
Route::controller( '/', 'HomeController');