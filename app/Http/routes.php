<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/home', 'AdminController@home');
Route::post('/home', 'AdminController@home');
Route::get('/login', 'AdminController@loginPage');
Route::post('/login', 'AdminController@login');
Route::get('/signup', 'AdminController@createUser');
Route::get('/logout','AdminController@logout');

//Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


//Route::get('')



// api requests

Route:get('/api/score','APIController@getScore');