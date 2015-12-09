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

Route::group(['middleware' => 'auth'] , function(){
	Route::get('/booking', 'BookingController@index');
	Route::post('/booking/create', 'BookingController@store');
	Route::put('/booking/update', 'BookingController@update');
	Route::delete('/booking/destroy', 'BookingController@destroy');
});


Route::group(['middleware' => 'role:admin'] , function(){
	Route::get('/admin/', 'Backend\HomeController@index');
	Route::post('/admin/create', 'Backend\HomeController@store');
	Route::put('/admin/update', 'Backend\HomeController@update');
	Route::delete('/admin/destroy', 'Backend\HomeController@destroy');
});