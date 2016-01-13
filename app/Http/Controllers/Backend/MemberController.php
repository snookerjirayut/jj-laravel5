<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use App\User;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.member.index');
    }

    public function search(Request $request){
        $rules = array(
                'page' =>'required',
                'pageSize' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result'=>false , 'message'=>'invalid input field.'));

        $role = $request->input('type');
        $active = $request->input('status');
        $email = $request->input('email');
        $page =  $request->input('page');
        $pageSize =  $request->input('pageSize');

        $skip = ($page -1)*$pageSize;

        //$sql = \DB::table('users');
        $sql = User::whereRaw('(1+1=2)');
        if($role == 99 && $active == 99 && !isset($email)){
            $user = $sql->limit($skip,$pageSize)->get();
            return response()->json(['result'=>true , 'data'=>$user , 'total' =>$sql->count() ]);
        }else if ($role == 99 && $active == 99 && isset($email)){
            $count =  $sql->email($email)->count();
            $user = $sql->email($email)->limit($skip,$pageSize)->get();
            return response()->json(['result'=>true , 'data'=>$user , 'total' =>$count ]);
        }

        if(isset($role) && $role != 99) $sql->role($role);
        if(isset($active) && $active != 99) $sql->active($active);
        if(isset($email)) $sql->email($email);
        $sql_str = $sql->toSql();
        $count = $sql->count();
        $user = $sql->limit($skip,$pageSize)->get();

        //var_dump($role , $active);
        return response()->json(['result'=>true , 'data'=>$user , 'total' =>$count , 'sql'=>$sql_str ]);


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
