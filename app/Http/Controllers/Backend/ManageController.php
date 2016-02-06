<?php

namespace App\Http\Controllers\Backend;

use App\Booking;
use App\BookingDetail;
use App\Calendar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $page = $request->input('page');
        $pageSize = $request->input('pageSize');
        $skip = ($page -1) *  $pageSize;

        $calendars = Calendar::where('active', 1)->groupBy('opened_at')->skip($skip)->take($pageSize)->get();
        $count  = count(Calendar::where('active', 1)->groupBy('opened_at')->get());
        if($calendars == null) return response()->json(['result'=>false , 'message' => 'can not get calendar.']);
        foreach ($calendars as $key => $calendar) {
            $calendar->booking = Booking::where('sale_at', $calendar->opened_at . ' 00:00:00')
                ->whereNotIn('status',['RM'])->count();

            $calendar->checkin = Booking::where('sale_at', $calendar->opened_at. ' 00:00:00')->where('status', 'CN')->count();

            $calendar->undefine = Booking::where('sale_at', $calendar->opened_at. ' 00:00:00')->where('status', 'BK')->count();

        }
        return response()->json(['result'=>true , 'data'=> $calendars , 'message'=> 'success' , 'total'=>$count]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($date)
    {
        if($date == null)return response()->json(['result'=>false , 'message' => 'date can not be null.']);
        $booking = Booking::where('sale_at' ,$date. ' 00:00:00' )
            ->where('status' , 'BK')->update(['status'=>'RM' , 'active'=>0]);

        $booking_list = Booking::where('sale_at' ,$date. ' 00:00:00' )->where('status' , 'RM')->get();
        foreach($booking_list as $key => $book){
            BookingDetail::where('bookingID' , $book->id)->update(['status' => 'RM' , 'active'=>0]);
        }

        if($booking != null)
            return response()->json(['result'=>true , 'data'=> $booking , 'message'=> 'success']);
        return response()->json(['result'=>false , 'message' => 'clear fail.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
