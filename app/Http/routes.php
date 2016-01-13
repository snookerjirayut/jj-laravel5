<?php

use App\Zone;
use App\Calendar;
use Illuminate\Http\Response;
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
	if(!\Auth::check()){
		return redirect()->intended('/signin');
	}else{
		return redirect()->intended('/booking');
	}
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

	Route::post('/booking/search', 'BookingController@search');
	Route::get('/booking/calendar/day/get', 'BookingController@getDay');
	Route::get('/booking/calendar/zone/get/{date}', 'BookingController@getZone');
	Route::post('/booking/calendar/block/get', 'BookingController@getBlock');

	Route::get('/booking/summary/{id}', 'BookingController@summary');

	Route::get('/checkin', 'CheckinController@index');
	Route::post('/checkin/get', 'CheckinController@feed');
	Route::put('/checkin/save/{id}', 'CheckinController@update');



	Route::get('/inform', 'InformController@index');
	Route::get('/inform/feed', 'InformController@feed');
	Route::post('/inform/upload', 'InformController@upload');
	Route::put('/inform/update/{id}', 'InformController@update');


});

Route::get('/admin', 'Backend\HomeController@index');
Route::get('/admin/signin', 'Backend\HomeController@signin');
Route::get('/admin/signout', 'Backend\HomeController@signout');

Route::get('/admin/get/zone', function(){
	$zone = Zone::where('active', 1 )->get();
	return response()->json($zone);
});

Route::get('/admin/get/calendar', function(){
	$events = Calendar::where('active' , '1')->groupBy('opened_at')->get();
	return response()->json($events);
});
Route::get('/admin/get/calendar/{date}', function($date){
	$events = Calendar::where('active' , '1')->where('opened_at' , $date )->get();
	return response()->json($events);
});


Route::post('/admin/signin/valid', 'Backend\HomeController@check');


Route::group(['middleware' => 'role:admin'] , function(){
	Route::get('/admin/home', 'Backend\HomeController@index');

	Route::get('/admin/calendar', 'Backend\CalendarController@index');
	Route::post('/admin/calendar/save', 'Backend\CalendarController@store');
	Route::post('/admin/calendar/update', 'Backend\CalendarController@update');
	Route::get('/admin/calendar/delete/{date}', function($date){
		$events = Calendar::where('opened_at' , $date)->delete();
		return response()->json($events);
	});

	Route::get('/admin/payment', 'Backend\PaymentController@index');
	Route::get('/admin/payment/date', 'Backend\PaymentController@date');
	Route::get('/admin/payment/zone/{date}', 'Backend\PaymentController@zone');
	Route::post('/admin/payment/search', 'Backend\PaymentController@search');
	Route::post('/admin/payment/update', 'Backend\PaymentController@update');
	
});





