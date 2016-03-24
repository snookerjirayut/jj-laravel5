<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Booking;
use App\Zone;
use App\User;
use App\BookingDetail;
use Validator;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('history.index');
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
    public function show(Request $request)
    {
        //
        $rules = array(
            'page' =>'required',
            'pageSize' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result'=>false , 'message'=>$validator->errors()->first()));

        $page = $request->input('page');
        $pageSize = $request->input('pageSize');

        $skip = ($page - 1)* $pageSize;

        $user = \Auth::user();
        $count = Booking::where('userID' , $user->id)->count();
        $booking = Booking::where('userID' , $user->id)->orderBy('id' , 'desc')->skip($skip)->take($pageSize)->get();

        return response()->json(['result'=>true , 'data'=>$booking  , 'total'=>$count , 'skip'=>$skip , 'take' =>$pageSize ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!isset($id) || intval($id) <= 0){
            return redirect('/history');
        }

        $detail = BookingDetail::where('bookingID' , $id)->get();
       // dd($detail);
        return view('history.detail' , ['data' => $detail ]);

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
