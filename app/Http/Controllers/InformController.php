<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use Auth;

use App\Booking;

class InformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       // $user = Auth::user();
        //$booking = Booking::where('userID' ,  $user->id)->get();
        return view('inform.index');
    }

    public function feed(){
        $user = Auth::user();
        $booking = Booking::where('userID' ,  $user->id)->where('payment' , 0 )->where('type' , 1)->get();
        return response()->json(array('result'=>true ,'data' => $booking ));
    }


    public function upload(Request $request){
         $rules = array(
                'file' =>'required',
                'filename' =>'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result'=>false , 'message'=>'invalid input field.'));
        if($request->input('filename') == null || 
            $request->input('filename')  == "undefined") return response()->json(array('result'=>false , 'message'=>'กรุณาเลือกวันที่ก่อน'));

        $user = Auth::user();
        $imageName = $request->input('filename').'.'.$request->file('file')->getClientOriginalExtension();
        //var_dump($imageName);

        $result = $request->file('file')->move(
            base_path() . '/public/img/upload/', $imageName
        );

        return response()->json(array('result'=>true , 'filename' => $result->getFilename() ));
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
        $rules = array(
                'file' =>'required',
                'code' =>'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result'=>false , 'message'=>'invalid input field.'));

        $booking = Booking::where('code' , $request->input('code'))->first();
        $booking->picture = url('').'/img/upload/'.$request->input('file');
        $booking->payment = 1;
        if($booking->save()){
            return response()->json(array('result'=>true , 'message'=>'save success' , 'data'=>$booking ));
        }
        return response()->json(array('result'=>false , 'message'=>'save fail.'));

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
