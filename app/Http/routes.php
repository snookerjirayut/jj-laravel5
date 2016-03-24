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

Route::get('/register' , 'HomeController@register');
Route::post('/register/valid' , 'HomeController@store');

Route::get('/signin/', 'AuthenticationController@signin');
Route::get('/signout/', 'AuthenticationController@signout');
Route::post('/signin/valid', 'AuthenticationController@check');

Route::get('/contact', function(){ return view('contact.index'); });

Route::get('/summary/{id?}', 'BookingController@summary');


Route::group(['middleware' => 'auth'] , function(){
	Route::get('/booking', 'BookingController@index');
	Route::post('/booking/create', 'BookingController@store');

	Route::get('/monthly', 'MonthlyController@index');
	Route::post('/monthly/search', 'MonthlyController@search');
	Route::post('/monthly/create', 'MonthlyController@store');
	Route::post('/monthly/calendar/block/get', 'MonthlyController@getBlockMonthly');
	Route::get('/monthly/calendar/month/get', 'MonthlyController@getMonthly');
	Route::post('/monthly/save' , 'MonthlyController@save');


	Route::put('/booking/update', 'BookingController@update');
	Route::delete('/booking/destroy', 'BookingController@destroy');

	Route::get('/booking/createByAdmin', 'AdminBookingController@index')->name('/booking/createByAdmin');
	Route::post('/booking/create/admin', 'AdminBookingController@store');
	Route::post('/booking/search/admin', 'AdminBookingController@search');
	Route::post('/booking/save/admin', 'AdminBookingController@save');
	Route::get('/booking/destroy/admin', 'AdminBookingController@destroy');


	Route::get('/summary/admin/{id?}', 'BookingController@summaryByAdmin');
	Route::get('/booking/session/clear' , function(){
		session()->forget('member');
		return response()->json(["result"=>true]);
	});

	Route::post('/booking/search', 'BookingController@search');
	Route::get('/booking/calendar/day/get', 'BookingController@getDay');
	Route::get('/booking/calendar/zone/get/{date}', 'BookingController@getZone');
	Route::post('/booking/calendar/block/get', 'BookingController@getBlock');


	Route::get('/checkin', 'CheckinController@index');
	Route::post('/checkin/get', 'CheckinController@feed');
	Route::put('/checkin/save/{id}', 'CheckinController@update');

	Route::get('/inform', 'InformController@index');
	Route::get('/inform/monthly', 'InformController@indexMonthly');
	Route::get('/inform/feed', 'InformController@feed');
	Route::get('/inform/monthly/feed', 'InformController@feedMonthly');
	Route::post('/inform/upload', 'InformController@upload');
	Route::put('/inform/update/{id}', 'InformController@update');
	Route::put('/inform/monthly/update/{id}', 'InformController@updateMonthly');


	Route::get('/history', 'HistoryController@index');
	Route::post('/history/get', 'HistoryController@show');
	Route::get('/history/detail/{id}', 'HistoryController@edit');

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
	$events_inv = Calendar::where('active' , 0)->groupBy('opened_at')->get();
	return response()->json(['active'=>$events , 'inactive' => $events_inv]);
});

Route::get('/admin/get/zone/{date}', function($date){
	$zone = Calendar::where('active' , '1')->where('opened_at' , $date)->get();
	return response()->json(['zone'=>$zone]);
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

	Route::get('/admin/calendar/close/month/{date}' , 'Backend\CalendarController@closeMouth');
	Route::get('/admin/calendar/close/day/{date}' , 'Backend\CalendarController@closeDay');

	Route::get('/admin/payment', 'Backend\PaymentController@index');
	Route::get('/admin/payment/date', 'Backend\PaymentController@date');
	Route::get('/admin/payment/zone/{date}', 'Backend\PaymentController@zone');
	Route::post('/admin/payment/search', 'Backend\PaymentController@search');
	Route::post('/admin/payment/update', 'Backend\PaymentController@update');
	Route::get('/admin/payment/show/{id}', 'Backend\PaymentController@show');

	Route::get('/admin/paymentmonth', 'Backend\PaymentMonthlyController@index');
	Route::get('/admin/paymentmonth/date', 'Backend\PaymentMonthlyController@date');
	Route::get('/admin/paymentmonth/zone/{date}', 'Backend\PaymentMonthlyController@zone');
	Route::post('/admin/paymentmonth/search', 'Backend\PaymentMonthlyController@search');
	Route::post('/admin/paymentmonth/update', 'Backend\PaymentMonthlyController@update');
	Route::get('/admin/paymentmonth/show/{id}', 'Backend\PaymentMonthlyController@show');

	Route::get('/admin/member', 'Backend\MemberController@index');
	Route::post('/admin/member/search', 'Backend\MemberController@search');
	Route::put('/admin/member/update/{id}', 'Backend\MemberController@update');

	Route::get('/admin/manage' , 'Backend\ManageController@index');
	Route::post('/admin/manage/get' , 'Backend\ManageController@show');
	Route::get('/admin/manage/clear/{date}' , 'Backend\ManageController@update');

	Route::get('/admin/verify' , 'Backend\VerifyLockController@index');
	Route::post('/admin/verify/get' , 'Backend\VerifyLockController@show');
	Route::get('/admin/verify/update/{id}' , 'Backend\VerifyLockController@update');

	Route::get('/admin/booking/{id}' , 'Backend\BookingController@index');
});

Route::get('/utility/district/{zipcode?}' , function($zipcode){
	$aumphur = \DB::table('v_zipcode')->where('ZIPCODE' , $zipcode)->get();
	return response()->json(["data" => $aumphur]);
});





