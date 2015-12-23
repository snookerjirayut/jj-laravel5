<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

use App\Booking;
use App\Zone;
use App\User;
use App\BookingDetail;

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

        $booking = Booking::where('userID' , $user->id )->where('status','BK')->orderBy('id', 'desc')
        ->skip($skip)->take($pageSize)->get();
        //var_dump($skip ,  $pageSize);
        $count = Booking::where('userID' , $user->id )->where('status','BK')->count();

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
