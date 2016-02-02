<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\User;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        if(Auth::check())   
            return redirect()->intended('/booking');
        return view('register.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|min:6|max:12',
            'firstName' => 'required',
            'lastName' => 'required',
            'name' => 'required',
            'address' => 'required',
            'cardID' => 'required|min:13|max:13',
            'phone' => 'required',
            'amphurName' => 'required',
            'zipcode' => 'required',
            'districtName' => 'required',
            'provinceName' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result' => false, 'message' => $validator->errors()->first() ));

        $address = $request->input('address').' '.$request->input('districtName').' '
                        .$request->input('amphurName').' '.$request->input('provinceName').' '.$request->input('zipcode');

        $same = User::where('email' ,$request->input('email') )->count();
        if($same > 0)return response()->json(array('result' => false, 'message' => 'email is already in use.' ));

        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('Asia/Bangkok'));

        $user = new User();
        $user->name = $request->input('name');
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->cardID = $request->input('cardID');
        $user->address = $address;
        $user->phone = $request->input('phone');
        $user->code = $date->format('YmdHis');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->created_at = $date->format('Y-m-d H:i:s');
        $user->role = 1;
        
        if($user->save())
            return response()->json(array('result' => true, 'message' => 'success' ));
        else
            return response()->json(array('result' => false, 'message' => 'fail' ));
    }

    
}
