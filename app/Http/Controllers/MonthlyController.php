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

class MonthlyController extends Controller
{

    public function index()
    {
        if (Auth::user()->role != 2) return redirect('/');
        return view('monthly.index');
    }

    public function search(Request $request){
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


    public function thai_date($time)
    {
        $thai_day_arr = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
        $thai_month_arr = array(
            "1" => "มกราคม",
            "2" => "กุมภาพันธ์",
            "3" => "มีนาคม",
            "4" => "เมษายน",
            "5" => "พฤษภาคม",
            "6" => "มิถุนายน",
            "7" => "กรกฎาคม",
            "8" => "สิงหาคม",
            "9" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม"
        );

        $thai_date_return = "วัน" . $thai_day_arr[date("w", strtotime($time))];
        $thai_date_return .= "ที่ " . date("j", strtotime($time));
        $thai_date_return .= " " . $thai_month_arr[date("n", strtotime($time))];
        $thai_date_return .= " " . (date("Y", strtotime($time)) + 543);
        return $thai_date_return;
    }

    public function save(Request $request)
    {
        if(!$request->session()->has('quotation')) return redirect('/monthly')->withErrors("ไม่พบข้อมูลการจองพื้นที่");
        $rules = array('type' => 'required');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())  return redirect('/monthly')->withErrors($validator);
        $user = \Auth::user();
        if ( $user->role != 2)  return redirect('/monthly')->withErrors("user permission denied.");

        $quotation = $request->session()->get('quotation');
        $rows = $quotation["rows"];
        $products = $quotation["products"];
        $arr_product = explode('|' , $products);
        $name = $quotation["productName"];
        $booking_code = date('YmdHms') . '-' . $user->id;
        foreach( $rows as $key => $row){
            $booking = Booking::create([
                'sale_at' => $row->opened_at,
                'userID' => $user->id,
                'userCode' => $user->code,
                'quantity' => count($arr_product),
                'totalPrice' => $row->price,
                'code' => $booking_code,
                'productName' => $name ,
                'status' => 'BK',
                'type' => $request->input('type')
            ]);

            $this->saveDetail($booking , $arr_product , $user);
        }
        $request->session()->forget('quotation');
        return view('monthly.success', ['rows' => $quotation['rows']
            , 'products' => $quotation['products']
            , 'productName' => $quotation['productName']
            , 'thai_date' => $quotation['thai_date']
            , 'total_price' => $quotation['total_price']
            , 'booking_code' => $booking_code
            , 'type' => $request->input('type')
        ]);

    }

    private function saveDetail($booking , $locks , $user){
        $count = 0;
        foreach($locks as $key => $lock){
            $zoneCode =  substr( $lock , 0, 1);
            $calendar = Calendar::where( 'opened_at' , $booking->sale_at)->where('code' ,   $zoneCode)->first();

            $detail = BookingDetail::create([
                'code' => date('Ymd-His') . '-' . $user->id . '-' . ($count + 1),
                'bookingID' => $booking->id,
                'bookingCode' => $booking->code,
                'zoneID' => $calendar->zoneID,
                'zoneCode' => $calendar->code,
                'zoneNumber' =>  $lock ,
                'price' => $calendar->price_type2,
                'status' => 'BK',
                'sale_at' => $booking->sale_at
            ]);
            $count++;
        }
    }

    public function store(Request $request)
    {
        $thai_month_arr = array(
            "1" => "มกราคม",
            "2" => "กุมภาพันธ์",
            "3" => "มีนาคม",
            "4" => "เมษายน",
            "5" => "พฤษภาคม",
            "6" => "มิถุนายน",
            "7" => "กรกฎาคม",
            "8" => "สิงหาคม",
            "9" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม"
        );

        $rules = array(
            'products' => 'required',
            'date' => 'required',
            'productName' => 'required',
            'number' => 'required|integer',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())  return redirect('/monthly')->withErrors($validator);
        $user = \Auth::user();
        if ($user == null)  return redirect('/monthly')->withErrors("can not define user.");

        $products = $request->input('products');
        $month = $request->input('date');

        $sql = "SELECT * FROM calendar where date_format(opened_at , '%Y-%m') = date_format('". $month ."' , '%Y-%m') and code = '" . $request->input('code') . "' ";
        $sql .= " order by opened_at";
        $rows = \DB::select($sql);
        $total_price = 0 ;
        foreach ($rows as $key => $row) {
            $row->price = $row->price_type2 * $request->input('number');
            $row->thaidate = $this->thai_date($row->opened_at);
            $total_price += $row->price;
        }

        $quotation = ['products' => $products
            , 'rows' => $rows
            , 'date' => $month
            , 'thai_date' => $thai_month_arr[date("n", strtotime($month))] . ' ' . (date("Y", strtotime($month)) + 543)
            , 'productName' => $request->input('productName')
            , 'total_price' =>  $total_price
        ];

        $request->session()->put('quotation', $quotation);
        $params = $request->session()->get('quotation');

        return view('monthly.quotation', ['rows' => $params['rows']
            , 'products' => $params['products']
            , 'productName' => $params['productName']
            , 'thai_date' => $params['thai_date']
            , 'total_price' => $params['total_price']
        ]);

    }


    public function getMonthly(Request $request)
    {
        $days = \DB::select('SELECT  *, DATE_ADD(opened_at ,INTERVAL 543 YEAR ) as bdyear FROM calendar GROUP BY MONTH(opened_at)+\'-\'+YEAR(opened_at)');
        foreach ($days as $key => $value) {
            # code...
            $value->name = strtotime($value->opened_at) * 1000;
        }
        return response()->json($days);
    }


    public function getBlockMonthly(Request $request)
    {
        $date = $request->input('date');
        $blocks = BookingDetail::select('zoneNumber')->where('sale_at', $date . ' 00:00:00')
            ->whereIn('status', ['BK', 'CN'])->get();
        return response()->json($blocks);
    }

}