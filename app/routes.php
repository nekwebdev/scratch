<?php

/** ------------------------------------------
 *  Interface repository binding
 *  ------------------------------------------
 */
App::bind('UserRepositoryInterface', 'EloquentUserRepository');
App::bind('RoleRepositoryInterface', 'EloquentRoleRepository');

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

/**
 * API Group
 */
Route::group(array('prefix' => 'api/v1'), function()
{
    Route::resource('user', 'api\v1\UserController');
});

/**
 * Admin Group
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{
    // Users Management
    //Route::get('users/data', 'AdminUsersController@data'); // Outputs Datatables json
    Route::controller('users', 'admin\UserController');

    // User Role Management
    Route::get('roles/data', 'AdminRolesController@data'); // Outputs Datatables json
    Route::resource('roles', 'AdminRolesController');

    // Admin Home Page
    Route::controller('/', 'AdminHomeController');
});

/**
 * Frontend Group
 */
Route::group(array('prefix' => 'user'), function()
{
    Route::get('confirm/{code}', 'frontend\UserController@getConfirm');
	Route::get('reset/{token}', 'frontend\UserController@getReset');
	Route::controller( '/', 'frontend\UserController');
});

// Home Page
Route::controller( '/', 'HomeController');