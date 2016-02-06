<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Calendar;
use App\ViewBookingAndDetail;
use App\Booking;
use App\User;
use App\BookingDetail;
use Validator;

class VerifyLockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.verify.index');
    }

 
    public function show(Request $request)
    {
        $page = $request->input('page');
        $pageSize = $request->input('pageSize');
        $skip = ($page -1) *  $pageSize;

        $rules = array(
            'zone' => 'required',
            'date' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result' => false, 'message' => $validator->errors()->first() ));

        $temp_booking = ViewBookingAndDetail::where('sale_at' ,$request->input('date').' 00:00:00' )
            ->where('active' , 1)
            ->where('zoneID' ,  $request->input('zone'))
            ->groupBy('id')
            ->orderBy('zoneNumber')
            ->get();

        foreach ($temp_booking as $key => $value) {
            $value->detail = BookingDetail::where('bookingID' ,$value->id )->get();
            $value->user = User::where('id' , $value->userID )->first();
        }

        return  response()->json(['result' => true, 'message' => 'success', 'data' =>  $temp_booking]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $a = Booking::where('id' , $id)->update(['verify' => 1]);
        $b = BookingDetail::where('bookingID' , $id)->update(['verify' => 1]);

        if($a <= 0 || $b <= 0) return response()->json(['result' => false, 'message' => 'can not find this booking.']);

        $temp_booking = ViewBookingAndDetail::where('active' , 1)
            ->where('id' , $id)
            ->groupBy('id')
            ->orderBy('zoneNumber')
            ->get();
       foreach ($temp_booking as $key => $value) {
            $value->detail = BookingDetail::where('bookingID' ,$value->id )->get();
            $value->user = User::where('id' , $value->userID )->first();
        }

        return  response()->json(['result' => true, 'message' => 'success', 'data' =>  $temp_booking]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
