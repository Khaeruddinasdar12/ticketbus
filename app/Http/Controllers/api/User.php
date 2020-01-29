<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
// use Request;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\ApiAdminRequest;
use API;
use Auth;
class User extends Controller
{

    public function index()
    {
        $data = \App\Customer::all();

        $data = \App\User::where('role', 'kernet')->get();
        // $data = 
        return response()->json($data);   
    }

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            // $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['status' => true, 'message' => 'berhasil login', 'code' => 200]);
        }else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function store(Request $request)
    {
        $rules=array(
            'name' => 'required|min:2',
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'alamat' => 'required'
        );
        $messages=array(
            'name.required' => 'name field tidak boleh kosong',
            'username.required' => 'username field tidak boleh kosong',
            'password.required' => 'password field tidak boleh kosong',
            'email.required' => 'email field tidak boleh kosong',
            'role.required' => 'role field tidak boleh kosong',
            'alamat.required' => 'alamat field tidak boleh kosong',
            'username.unique' => 'username sudah ada',
            'email.email' => 'email field harus format email',
            'email.unique' => 'email sudah ada',
            'alamat.unique' => 'email sudah ada'
        );

        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            $messages=$validator->messages();
            $errors=$messages->all();
            return response()->json($errors, 500);
        }

        $data = new \App\User();
        $data->name = $request->name;
        $data->username = $request->username;
        $data->password = bcrypt($request->password);
        $data->email = $request->email;
        $data->role = $request->role;
        $data->alamat = $request->alamat;
        $data->save();

        return $arrayName = array('status' => 'OK', 'code' => 200, 'message' => 'Berhasil Menambah Data');
    }

    public function show($id)
    {
        $data = \App\User::find($id);
        return $data;
    }

    public function update(Request $request, $id)
    {
        
        $data = \App\User::find($id);
        $rules=array(
            'name' => 'required',
            'role' => 'required',
            'alamat' => 'required'
        );

        $messages=array(
            'name.required' => 'name field tidak boleh kosong',
            'role.required' => 'role field tidak boleh kosong',
            'alamat.required' => 'alamat field tidak boleh kosong',
        );

        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            $messages=$validator->messages();
            $errors=$messages->all();
            return response()->json($errors, 500);
        }

        
        $data->name = $request->name;
        $data->alamat = $request->alamat;
        $data->role = $request->role;
        $data->save();

        return $arrayName = array('status' => 'OK', 'code' => 200, 'message' => 'Berhasil Mengubah Data' );

    }

    public function destroy($id)
    {
        $data = \App\User::findOrFail($id);
        $data->delete();

        return $arrayName = array('status' => 'OK', 'code' => 200, 'message' => 'Berhasil Menghapus Data' );
    }
}
