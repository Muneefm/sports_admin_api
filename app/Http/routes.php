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

Route::get('/populate_event_list','AdminController@eventpop');




Route::get('/home', 'AdminController@home');
Route::post('/home', 'AdminController@home');
Route::get('/login', 'AdminController@loginPage');
Route::post('/login', 'AdminController@login');
Route::get('/signup', 'AdminController@createUser');
Route::get('/logout','AdminController@logout');

Route::get('/group_blue','AdminController@getBlue');
Route::post('/add_blue','AdminController@getBlue');

Route::get('/group_green','AdminController@getGreen');
Route::post('/add_green','AdminController@getGreen');

Route::get('/group_yellow','AdminController@getYellow');
Route::post('/add_yellow','AdminController@getYellow');

Route::get('/group_red','AdminController@getRed');
Route::post('/add_red','AdminController@getRed');

//events
Route::get('/event','AdminController@getEvent');
Route::post('/add_event_list','AdminController@getEvent');

//events
Route::get('/winners','AdminController@getWinners');
Route::post('/add_winners','AdminController@getWinners');

//image Upload
Route::get('/up_image','AdminController@imageUpload');
Route::post('/up_image','AdminController@imageUpload');

Route::get('/gallery','AdminController@openGallery');

Route::get('/parse_excel','AdminController@excelView');
Route::post('/parse_excel','AdminController@excelParse');



//Route::get('home', 'HomeController@index');
// DETE ROUTES

Route::get('/del_group','DeleteController@deleteFromGroup');
Route::get('/del_eventlist','DeleteController@deleteFromEvent');
Route::get('/del_winner','DeleteController@deleteFromWinners');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


//Route::get('')



// api requests

Route::get('/api/score','APIController@getScore');
Route::get('/api/group','APIController@getGroupMenbers');
Route::get('/api/group_search','APIController@searchGroup');
Route::get('/api/images','APIController@imageGallery');
Route::get('/api/events','APIController@getEvents');