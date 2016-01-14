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
        if ($validator->fails()) return response()->json(array('result'=>false , 'message'=>$validator->errors()->first()));

        $role = $request->input('type');
        $active = $request->input('status');
        $email = $request->input('email');
        $page =  $request->input('page');
        $pageSize =  $request->input('pageSize');

        $skip = ($page -1)*$pageSize;

        //$sql = \DB::table('users');
        $sql = User::whereRaw('(1+1=2)')->where('isAdmin', 0);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
                'id' =>'required',
                'email' =>'required',
                'role' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json(array('result'=>false , 'message'=>$validator->errors()->first()));

        $user = User::where('id', $id )->first();
        $user->role = $request->input('role');
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        if($user->save())
            return response()->json(array('result'=>true , 'message'=>'success' , 'data'=>$user ));
        return response()->json(array('result'=>false , 'message'=>'update fail.' , 'data'=>$user  ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
