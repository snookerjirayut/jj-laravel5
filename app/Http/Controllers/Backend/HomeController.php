<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
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
        if(Auth::check()){
            if(Auth::user()->role < 90){
                Auth::logout();
                return redirect()->intended('/admin/signin?role=lessadmin');
            } 
        }else{
            return redirect()->intended('/admin/signin?auth=fail');
        }
        return view('admin.home');
    }

    public function signin()
    {
        return view('admin.signin');
    }

    public function signout()
    {
        Auth::logout();
        return redirect()->intended('/admin/signin');
    }

    public function check(Request $request)
    {
        $rules = array(
                'email' =>'required|email',
                'password' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return redirect('/admin/signin?a')->withErrors($validator , 'auth');
        
        $email = $request->input('email');
        $password = $request->input('password');
        
       if(Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1, 'isAdmin' => 1 ] )){
            //var_dump('role', Auth::user());
            return redirect()->intended('/admin/');
        }
       // var_dump(Auth::user());
       return redirect()->intended('/admin/signin?e')->withErrors('Please check your email or password again.');
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
