<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Calendar;
use App\Booking;
use App\BookingDetail;
use App\User;
use App\ViewBookingAndDetail;
use Validator;

class PaymentMonthlyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.paymentmonth.index');
    }

    public function date(){
        $calendar = Calendar::where('active', 1)->groupBy('opened_at')->get();
        if($calendar == null)  return response()->json(['result'=>false , 'message' => 'can not get booking calendar.' ]);

        return response()->json(['result'=>true , 'data' => $calendar , 'message' => 'success' ]);
    }

    public function zone($date){
        if($date == null) return response()->json(['result'=>false , 'message' => 'please select date.' ]);
        $calendar = Calendar::where('active', 1)->where('opened_at' , $date)->orderBy('code')->get();
        if($calendar == null)  return response()->json(['result'=>false , 'message' => 'can not get booking calendar.' ]);
        return response()->json(['result'=>true , 'data' => $calendar , 'message' => 'success' ]);
    }

    public function search(Request $request){
        $rules = array(
            'date' =>'required',
            'page' => 'required',
            'pageSize'  => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result'=>false , 'message'=>$validator->errors()->first() ));

        $zone = $request->input('zone');
        $type = $request->input('type');
        $status = $request->input('status');

        $date = $request->input('date').' 00:00:00';
        $page = $request->input('page');
        $pageSize = $request->input('pageSize');

        $skip = ($page - 1) * $pageSize;

        if($zone == 99 && $type == 99 && $status == 99){
            $booking = Booking::where('sale_at' , $date)->skip($skip)->take($pageSize)->get();
            $count = Booking::where('sale_at' , $date)->count();
            return response()->json(['result'=>true , 'data'=> $booking , 'total'=>$count ]);
        }

        $query = \DB::table('v_booking_and_detail')->where('sale_at' , $date)->groupBy('code');

        if(isset($zone) && $zone != 99) $query->where('zoneID' , $zone);
        if(isset($type) && $type != 99) $query->where('type' , $type);
        if(isset($status) && $status != 99) $query->where('payment' , $status);


        /* \Event::listen('illuminate.query', function($query)
         {
             var_dump($query);
         });*/

        $countQuery = $query->groupBy('id');

        $booking = $query->skip($skip)->take($pageSize)->get();

        $sql =  $query->toSql();

        $count = ViewBookingAndDetail::from(\DB::raw('('.$countQuery->toSql().')  as table_count'))
            ->mergeBindings($countQuery)->count();

        return response()->json(['result'=>true , 'data'=> $booking , 'total'=>$count , 'sql' => $sql]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $booking = Booking::where('code' , $id)->get();
        if($booking == null) return response()->json(['result'=>false , 'message'=>'can not get this booking detail.' ]);

        $grandprice = 0;
        foreach($booking as $key => $book){
            $book->detail = BookingDetail::where('bookingID' , $book->id)->get();

            $grandprice += $book->totalPrice;
        }

        $user = User::where('id' , $booking[0]->userID )->first();

        return response()->json(['result'=>true , 'message'=>'success' , 'data'=>$booking , 'user'=>$user , 'grandprice' =>$grandprice ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = array('bookingid' =>'required');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result'=>false , 'message'=>$validator->errors()->first() ));

        $booking_id = $request->input('bookingid');
        $booking = Booking::where('code' , $booking_id )->update(['payment' => 2]);

        if($booking)
            return response()->json(array('result'=>true , 'message'=>'success' ));
        return response()->json(array('result'=>false , 'message'=>'update fail'));
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
