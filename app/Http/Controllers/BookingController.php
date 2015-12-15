<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Calendar;
use App\Booking;
use App\Zone;
use App\BookingDetail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('booking.index');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Bangkok'));

        $rules = array(
                'products' =>'required',
                'date' => 'required',
                'productName' => 'required',
                'totalPrice' => 'required|integer',
                'number' => 'required|integer',

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result'=>false , 'message'=>'invalid input field.'));

        $user = \Auth::user();
        if($user == null)return response()->json(array('result'=>false , 'message'=>'user is not define.'));

        $booking = Booking::create([
            'sale_at' => $request->input('date'),
            'userID' => $user->id,
            'userCode' => $user->code , 
            'quantity' =>  $request->input('number'),
            'totalPrice' =>  $request->input('totalPrice'),
            'code' => $date->format('Ymd-His').'-'.$user->id,
            'productName' => $request->input('productName'),
            'status' => 'BK'
        ]);

        if($booking == null)return response()->json(array('result'=>false , 'message'=>'booking create fails.'));

        //$open = (object) $arr[$i];
        $products_arr = $request->input('products');
        $count = 0;
        $detail_result = [];
        foreach ($products_arr as $key => $product_arr) {
            # code...
            $product = (object) $product_arr;

            $calendar = Calendar::where('opened_at' , $request->input('date'))->where('code',$product->code)->get()->first();

            $detail =  BookingDetail::create([
                'code' => $date->format('Ymd-His').'-'.$user->id.'-'.($count+1),
                'bookingID' =>  $booking->id,
                'bookingCode' => $booking->code,
                'zoneID' => $calendar->zoneID , 
                'zoneCode' => $calendar->code , 
                'zoneNumber' => $product->name ,
                'price' => $product->price ,
                'status' => 'BK',
                'sale_at' => $request->input('date')
            ]);

            if($detail != null) {
                array_push($detail_result , $detail->id);
                $count++;
            }
        }//end foreach

        if($count == count($products_arr)){
            return response()->json(array('result'=>true , 'message'=>'success' 
                , 'booking' => $booking->id , 'detail' => $detail_result   
            ));
        }
        return response()->json(array('result'=>false , 'message'=>'booking create fails.'));

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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
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

    public function search(Request $request){
        $rules = array(
                'date' =>'required',
                'zoneName' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result'=>false , 'message'=>'invalid input field.'));
        $block = Calendar::where('active' , 1 )
            ->where('opened_at' , $request->input('date'))
            ->where('name' , $request->input('zoneName'))->get();

        return response()->json(array('result'=>true , 'message'=>'success.' , 'data'=>$block ));
    }

    public function getDay(Request $request){
        $days = Calendar::select('opened_at')->where('active' , 1 )->groupBy('opened_at')->get();
        foreach ($days as $key => $value) {
            # code...
            $value->name = date("D j F Y", strtotime($value->opened_at));
        }
        return response()->json($days);
    }

    public function getZone($date){
        $zones = Calendar::where('opened_at' , $date )->groupBy('name')->get();
        return response()->json($zones);
    }

    public function getBlock(Request $request){
        $date = $request->input('date');
        $zone = $request->input('zoneName');
        $blocks = BookingDetail::select('zoneNumber')->where('sale_at' , $date.' 00:00:00' )->get();
        return response()->json($blocks);
    }
}
