<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Calendar;
use App\Booking;
use App\BookingDetail;
use Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.payment.index');
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
                'zone' => 'required',
                'type' => 'required',
                'status' => 'required',
                'page' => 'required',
                'pageSize'  => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result'=>false , 'message'=>'invalid input field.'));

        $zone = $request->input('zone'); 
        $type = $request->input('type'); 
        $status = $request->input('status'); 

        $date = $request->input('date'); 
        $page = $request->input('page'); 
        $pageSize = $request->input('pageSize'); 

        $skip = ($page - 1) * $pageSize;

        if($zone == 99 && $type == 99 && $status == 99){
            $booking = Booking::where('sale_at' , $date)->skip($skip)->take($pageSize)->get();
            $count = Booking::where('sale_at' , $date)->skip($skip)->take($pageSize)->count();
            return response()->json(['result'=>true , 'data'=> $booking , 'total'=>$count ]);
        }

        if($zone != 99){
            $query = \DB::table('v_booking_and_detail')->where('sale_at' , $date)->where('zoneID' , $zone);
        }else if($zone != 99 && $type != 99){
            $query = $query->where('type' , $type);
        }else if($zone != 99 && $type != 99 && $status != 99){
            $query = $query->where('status' , $status);
        }

        $booking = $query->groupBy('id')->skip($skip)->take($pageSize)->get();
        $sql = $query->groupBy('id')->skip($skip)->take($pageSize)->toSql();
        $count = $query->groupBy('id')->skip($skip)->take($pageSize)->count();

        return response()->json(['result'=>true , 'data'=> $booking , 'total'=>$count , 'sql' =>$sql  ]);
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
    public function update(Request $request, $id)
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
}
