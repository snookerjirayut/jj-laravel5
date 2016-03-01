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
        if (Auth::user()->role == 2) {
            return redirect('/inform/monthly');
        }
        return view('inform.index');
    }

    public function indexMonthly()
    {
        return view('inform.indexMonthly');
    }

    public function feed()
    {
        $user = Auth::user();
        $booking = Booking::where('userID', $user->id)->where('payment', 0)->where('type', 1)->get();
        return response()->json(['result' => true, 'data' => $booking]);
    }

    public function feedMonthly()
    {
        $user = Auth::user();
        $booking = Booking::where('userID', $user->id)->where('payment', 0)
            ->where('type', 1)
            ->groupBy('code')
            ->orderBy('sale_at', 'asc')
            ->get();
        return response()->json(['result' => true, 'data' => $booking]);
    }

    public function upload(Request $request)
    {
        $rules = array(
            'file' => 'required',
            'filename' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result' => false, 'message' => 'invalid input field.'));
        if ($request->input('filename') == null ||
            $request->input('filename') == "undefined"
        ) return response()->json(array('result' => false, 'message' => 'กรุณาเลือกวันที่ก่อน'));

        $user = Auth::user();
        $filename = md5($request->input('filename'));
        $imageName = $filename . '.' . $request->file('file')->getClientOriginalExtension();

        $path = base_path() . '/public/img/upload/'. $user->id;
        //$path_full = base_path() . '/public/img/upload/'.$imageName;

        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }
        $result = $request->file('file')->move( $path  , $imageName);
        //base_path() . '/public/img/upload/', $imageName

        return response()->json(array('result' => true, 'filename' => $result->getFilename()));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'file' => 'required',
            'code' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result' => false, 'message' => 'invalid input field.'));

        $booking = Booking::where('code', $request->input('code'))->first();
        $booking->picture = url('') . '/img/upload/' . $request->input('file');
        $booking->payment = 1;
        if ($booking->save()) {
            return response()->json(array('result' => true, 'message' => 'save success', 'data' => $booking));
        }
        return response()->json(array('result' => false, 'message' => 'save fail.'));

    }

    public function updateMonthly(Request $request, $id)
    {
        $rules = array(
            'file' => 'required',
            'code' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result' => false, 'message' => 'invalid input field.'));
        $path = url('') . '/img/upload/' . $request->input('file');

        $booking = Booking::where('code', $request->input('code'))->where('payment', '0')
            ->update(['payment' => 1, 'picture' => $path]);

        if ($booking != null)
            return response()->json(array('result' => true, 'message' => 'save success', 'data' => $booking));
        return response()->json(array('result' => false, 'message' => 'save fail.'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
