<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Calendar;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.calendar.index');
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array('open' =>'required', 'date' =>'required');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array( 'result' => false , 'message' => 'valid input.' ));

        $count = 0;
        $arr = $request->input('open');
        for($i = 0; $i < count( $arr ); $i++){
            $open = (object) $arr[$i];
            if(isset($open->value)){
                //check date 
                /*$day = date('l');*/
                if($open->value){
                    $calendar = new Calendar();
                    $calendar->code = $open->code;
                    $calendar->zoneID = $open->id;
                    $calendar->name = $open->name;
                    $calendar->maxLock = $open->maxLock;
                    $calendar->row = $open->row;
                    $calendar->availableLock = ($open->maxLock - $open->close);
                    $calendar->price_type1 = $open->price_type1;
                    $calendar->price_type2 = $open->price_type2;
                    $calendar->active = $open->active;
                    $calendar->opened_at = $request->input('date').' 00:00:00';
                    $calendar->created_at = date("Y-m-d H:i:s");
                    $calendar->save();
                    $count++;
                }
            }
        }
        return response()->json(array( 'result' => true , 'message' => 'success ['.$count.'].' ));
      
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

    public function closeMouth($date){
        if (!isset($date)) return response()->json(array( 'result' => false , 'message' => 'valid input.' ));
        $date = date("Y-m", strtotime($date));
        $name = date("F", strtotime($date));
        $calendars = Calendar::where('opened_at' , 'like' , $date.'%')->update(['active' => 0]);
        if(isset($calendars))
            return response()->json(array( 'result' => true , 'message' => 'Close '.$name.' success' ));
        return response()->json(array( 'result' => false , 'message' => 'Close '.$name.' fail.' ));
    }

     public function closeDay($date){
        if (!isset($date)) return response()->json(array( 'result' => false , 'message' => 'valid input.' ));
        $date = date("Y-m-d", strtotime($date));
        $calendars = Calendar::where('opened_at' , $date)->update(['active' => 0]);
        if(isset($calendars))
            return response()->json(array( 'result' => true , 'message' => 'Close '.$date.' success' ));
        return response()->json(array( 'result' => false , 'message' => 'Close '.$name.' fail.' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = array('open' =>'required', 'date' =>'required');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array( 'result' => false , 'message' => 'valid input.' ));

        $count = 0;
        $arr = $request->input('open');
        for($i = 0; $i < count( $arr ); $i++){
            $open = (object) $arr[$i];
            if(isset($open->value)){
                if($open->value){
                    if(!isset($open->calendarID))
                        $open->calendarID = 0;
                    $calendar = Calendar::where('id' , $open->calendarID)->get()->first();
                    if(!isset($calendar)){ $calendar = new Calendar(); }
                    $calendar->code = $open->code;
                    $calendar->zoneID = $open->id;
                    $calendar->name = $open->name;
                    $calendar->maxLock = $open->maxLock;
                    $calendar->row = $open->row;
                    $calendar->availableLock = ($open->maxLock - $open->close);
                    $calendar->price_type1 = $open->price_type1;
                    $calendar->price_type2 = $open->price_type2;
                    $calendar->active = $open->active;
                    $calendar->opened_at = $request->input('date').' 00:00:00';
                    $calendar->created_at = date("Y-m-d H:i:s");
                    $calendar->save();
                    $count++;
                }else{
                      if(isset($open->calendarID)){ $calendar = Calendar::where('id' , $open->calendarID)->delete(); }
                }
            }
        }
        return response()->json(array( 'result' => true , 'message' => 'success ['.$count.'].' , 'id'=>$request->input('date') ));
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
