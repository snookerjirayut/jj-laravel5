<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Calendar;
use App\Booking;
use App\Zone;
use App\User;
use App\BookingDetail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;

use Auth;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 2) return redirect('/monthly');
        return view('booking.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createByAdmin()
    {
        if(!session()->has('member')) return response()->json(['message'=>'member not found.']);
        //var_dump(Auth::user()->role);
        if(Auth::user()->role != 99) return response()->json(['message'=>'permission denied']);
        return view('booking.byadmin' , ['user' => session()->get('member')]);
    }

    public function summary($id)
    {
        //if($id == null){ return redirect()->intended('/'); }
        $booking = Booking::where('code', $id)->get()->first();
        $detail = BookingDetail::where('bookingCode', $id)->get();
        foreach ($detail as $key => $value) {
            # code...
            $zone = Zone::where('code', $value->zoneCode)->get()->first();
            $detail->zoneName = $zone->name;
        }

        $user = User::where('id', $booking->userID)->get()->first();
        //var_dump($booking , $detail);
        return view('booking.summary', ['booking' => $booking, 'detail' => $detail, 'user' => $user]);
    }

    public function summaryByAdmin($id)
    {
        $booking = Booking::where('code', $id)->get()->first();
        $detail = BookingDetail::where('bookingCode', $id)->get();
        foreach ($detail as $key => $value) {
            # code...
            $zone = Zone::where('code', $value->zoneCode)->get()->first();
            $detail->zoneName = $zone->name;
        }

        $user = session()->get('member');
        //var_dump($booking , $detail);
        return view('booking.summarybyadmin', ['booking' => $booking, 'detail' => $detail, 'user' => $user]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Bangkok'));

        $rules = array(
            'products' => 'required',
            'date' => 'required',
            'productName' => 'required',
            'totalPrice' => 'required|integer',
            'number' => 'required|integer',

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result' => false, 'message' => 'invalid input field.'));

        $user = \Auth::user();
        if ($user == null) return response()->json(array('result' => false, 'message' => 'user is not define.'));
        $booking_code = date('YmdHms') . '-' . $user->id;
        $booking = Booking::create([
            'sale_at' => $request->input('date'),
            'userID' => $user->id,
            'userCode' => $user->code,
            'quantity' => $request->input('number'),
            'totalPrice' => $request->input('totalPrice'),
            'code' => $booking_code,
            'productName' => $request->input('productName'),
            'status' => 'BK',
            'type' => $request->input('type'),
            'payment_type' => 1
        ]);

        if ($booking == null) return response()->json(array('result' => false, 'message' => 'booking create fails.'));

        //$open = (object) $arr[$i];
        $products_arr = $request->input('products');
        $count = 0;
        $detail_result = [];
        foreach ($products_arr as $key => $product_arr) {
            # code...
            $product = (object)$product_arr;

            $calendar = Calendar::where('opened_at', $request->input('date'))->where('code', $product->code)->get()->first();

            $detail = BookingDetail::create([
                'code' => $date->format('Ymd-His') . '-' . $user->id . '-' . ($count + 1),
                'bookingID' => $booking->id,
                'bookingCode' => $booking->code,
                'zoneID' => $calendar->zoneID,
                'zoneCode' => $calendar->code,
                'zoneNumber' => $product->name,
                'price' => $product->price,
                'status' => 'BK',
                'sale_at' => $request->input('date')
            ]);

            if ($detail != null) {
                array_push($detail_result, $detail->id);
                $count++;
            }
        }//end foreach

        if ($count == count($products_arr)) {
            return response()->json(array('result' => true, 'message' => 'success'
            , 'bookingCode' => $booking->code, 'detail' => $detail_result
            ));
        }
        return response()->json(array('result' => false, 'message' => 'booking create fails.'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeByAdmin(Request $request)
    {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Bangkok'));

        $rules = array(
            'products' => 'required',
            'date' => 'required',
            'productName' => 'required',
            'totalPrice' => 'required|integer',
            'number' => 'required|integer',

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(['result' => false, 'message' => 'invalid input field.']);

        $user = session()->get('member');
        if ($user == null) return response()->json(['result' => false, 'message' => 'user is not define.']);
        
        $booking = Booking::create([
            'sale_at' => $request->input('date'),
            'userID' => $user->id,
            'userCode' => $user->code,
            'quantity' => $request->input('number'),
            'totalPrice' => $request->input('totalPrice'),
            'code' => $date->format('Ymd-His') . '' . $user->id,
            'productName' => $request->input('productName'),
            'status' => 'BK',
            'type' => $request->input('type'),
            'payment_type' => 1
        ]);

        if ($booking == null) return response()->json(['result' => false, 'message' => 'booking create fails.']);

        //$open = (object) $arr[$i];
        $products_arr = $request->input('products');
        $count = 0;
        $detail_result = [];
        foreach ($products_arr as $key => $product_arr) {
            # code...
            $product = (object)$product_arr;

            $calendar = Calendar::where('opened_at', $request->input('date'))->where('code', $product->code)->get()->first();

            $detail = BookingDetail::create([
                'code' => $date->format('Ymd-His') . '-' . $user->id . '-' . ($count + 1),
                'bookingID' => $booking->id,
                'bookingCode' => $booking->code,
                'zoneID' => $calendar->zoneID,
                'zoneCode' => $calendar->code,
                'zoneNumber' => $product->name,
                'price' => $product->price,
                'status' => 'BK',
                'sale_at' => $request->input('date')
            ]);

            if ($detail != null) {
                array_push($detail_result, $detail->id);
                $count++;
            }
        }//end foreach

        if ($count == count($products_arr)) {
            return response()->json(array('result' => true, 'message' => 'success'
            , 'bookingCode' => $booking->code, 'detail' => $detail_result
            ));
        }
        return response()->json(array('result' => false, 'message' => 'booking create fails.'));

    }


    public function search(Request $request)
    {
        $rules = array(
            'date' => 'required',
            'zoneName' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result' => false, 'message' => 'invalid input field.'));

        $user = Auth::user();

        $booking_count = Booking::where('sale_at', $request->input('date'))->where('userID', $user->id)->count();
        if ($booking_count > 0) {
            return response()->json(array('result' => false, 'message' => 'บัญชีนี้ได้ทำการจองไปแล้ว กรุณาตรวจสอบใหม่อีกครั้ง'));
        }


        $block = Calendar::where('active', 1)
            ->where('opened_at', $request->input('date'))
            ->where('name', $request->input('zoneName'))->groupBy('code')->get();

        return response()->json(array('result' => true, 'message' => 'success.', 'data' => $block));
    }

    public function searchByAdmin(Request $request)
    {
        $rules = array(
            'date' => 'required',
            'zoneName' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result' => false, 'message' => 'invalid input field.'));

        $user = session()->get('member');

        $booking_count = Booking::where('sale_at', $request->input('date'))->where('userID', $user->id)->count();
        if ($booking_count > 0) {
            return response()->json(['result' => false, 'message' => 'บัญชีนี้ได้ทำการจองไปแล้ว กรุณาตรวจสอบใหม่อีกครั้ง']);
        }

        $block = Calendar::where('active', 1)
            ->where('opened_at', $request->input('date'))
            ->where('name', $request->input('zoneName'))->get();

        return response()->json(array('result' => true, 'message' => 'success.', 'data' => $block));
    }

    public function getDay(Request $request)
    {
        $days = Calendar::select('opened_at')->where('active', 1)->groupBy('opened_at')->get();
        foreach ($days as $key => $value) {
            # code...
            $value->name = strtotime($value->opened_at) * 1000;

        }
        return response()->json($days);
    }

    public function getZone($date)
    {
        $zones = Calendar::where('opened_at', $date)->groupBy('name')->get();
        return response()->json($zones);
    }

    public function getBlock(Request $request)
    {
        $date = $request->input('date');
        $zone = $request->input('zoneName');
        $blocks = BookingDetail::select('zoneNumber')->where('sale_at', $date . ' 00:00:00')
            ->whereIn('status', ['BK', 'CN'])->get();
        return response()->json($blocks);
    }
}
