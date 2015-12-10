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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signin/', 'AuthenticationController@signin');
Route::get('/signout/', 'AuthenticationController@signout');
Route::post('/signin/valid', 'AuthenticationController@check');


Route::group(['middleware' => 'auth'] , function(){
	Route::get('/booking', 'BookingController@index');
	Route::post('/booking/create', 'BookingController@store');
	Route::put('/booking/update', 'BookingController@update');
	Route::delete('/booking/destroy', 'BookingController@destroy');
});

Route::get('/admin/signin', 'Backend\HomeController@signin');
Route::post('/admin/signin/valid', 'Backend\HomeController@check');

Route::group(['middleware' => 'role:admin'] , function(){
	Route::get('/admin/home', 'Backend\HomeController@index');
	Route::get('/admin/calendar', 'Backend\CalendarController@index');
	Route::post('/admin/create', 'Backend\HomeController@store');
	Route::put('/admin/update', 'Backend\HomeController@update');
	Route::delete('/admin/destroy', 'Backend\HomeController@destroy');
});