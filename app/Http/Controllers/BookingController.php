<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Calendar;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
}
