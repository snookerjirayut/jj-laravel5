<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Validator;

use App\Booking;
use App\Zone;
use App\User;
use App\BookingDetail;

use DateTime;
use DateTimeZone;

class CheckinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkin.index');
    }

    public function feed(Request $request){
        if(!Auth::check()) return response()->json(array('result'=>false , 'message'=>'user is not define.'));
        $user = Auth::user();

        $pageSize = $request->input('pageSize');
        $currentPage = $request->input('currentPage');

        $skip = ($currentPage - 1 ) * $pageSize;

        $booking = Booking::where('userID' , $user->id )
            ->whereRaw(' DATE_FORMAT(sale_at, \'%Y-%m-%d\') >=  DATE_FORMAT(NOW(), \'%Y-%m-%d\')')
            ->whereNotIn('status', ['RM'])->orderBy('sale_at', 'asc')
            ->skip($skip)->take($pageSize)->get();

        $count = Booking::where('userID' , $user->id )->whereNotIn('status' , ['RM'])->count();

        foreach ($booking  as $key => $value) {
            # code...
             $temp = bookingDetail::where('bookingID' , $value->id)->get();
             //$temp->miliseconds = $temp->sale_at;
             $value->bookingDetail = $temp;

        }
        if($booking == null)return response()->json(array('result'=>false , 'message'=>'booking is null.' , 'data' => $booking , 'total' => $count ));
        return response()->json(array('result'=>true , 'message'=>'success.' , 'data' => $booking , 'total' => $count ));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id == null) return response()->json(array('result'=>false , 'message'=>'Booking id can not be null.'));
        
         $rules = array(
                'id' =>'required',
                'code' =>'required',
                'canCheckIn' => 'required|boolean:true',
                'bookingDetail' => 'required|array'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result'=>false , 'message'=>'invalid input field.'));


        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Bangkok'));

        $booking = Booking::where('id' , $id)->first();
        $booking->status = 'CN';
        $booking->checkin_at =  $date->format('Y-m-d H:i:s');
        $result = $booking->save();

        if(!$result) return response()->json(array('result'=>false , 'message'=>'Booking id $id check-in has error.')); 

       
        BookingDetail::where('bookingID' , $id)->update(['status' => 'CN']);


        return response()->json(array('result'=>true , 'message'=>'success.'));

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
