<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
// use Request;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\ApiAdminRequest;
use API;
use Auth;
use Carbon\Carbon;
class User extends Controller
{
    public function login(){ // logic untuk login
        if(Auth::attempt(['email' => request('user'), 'password' => request('password') ]) || 
            Auth::attempt(['username' => request('user'), 'password' => request('password') ])){
            $id = Auth::user()->id;

            $data = \App\User::find($id);
            return response()->json([
                'status' => true, 
                'message' => 'berhasil login', 
                'code' => 200, 
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => false, 
                'message' => 'kesalahan pada username, email atau password', 
                'code' => 401
            ]);
            // return response()->json(['error'=>'Unauthorised', 401]);
        }
    }

    public function register(Request $request) // fungsi registrasi
    {
        $rules=array(
            'name' => 'required|min:2',
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'alamat' => 'required',
            'jkel'  => 'required'
        );
        $messages=array(
            'name.required' => 'name field tidak boleh kosong',
            'username.required' => 'username field tidak boleh kosong',
            'password.required' => 'password field tidak boleh kosong',
            'email.required' => 'email field tidak boleh kosong',
            'alamat.required' => 'alamat field tidak boleh kosong',
            'username.unique' => 'username sudah ada',
            'email.email' => 'email field harus format email',
            'email.unique' => 'email sudah ada',
            'alamat.unique' => 'email sudah ada',
            'jkel.required' => 'jkel field tidak boleh kosong'
        );

        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            $messages=$validator->messages();
            $errors=$messages->all();
            return response()->json($errors, 406);
        }

        $data = new \App\User();
        $data->name = $request->name;
        $data->username = $request->username;
        $data->password = bcrypt($request->password);
        $data->email = $request->email;
        $data->jkel = $request->jkel;
        $data->role = 'customer';
        $data->alamat = $request->alamat;
        $data->created_at = Carbon::now();
        $data->save();

        $user = \App\User::find($data->id);
        return response()->json([
                'status' => true, 
                'message' => 'Registrasi berhasil', 
                'code' => 201, 
                'data' => $user
            ]);
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

        $data->jkel = $request->jkel;
        $data->name = $request->name;
        $data->alamat = $request->alamat;
        $data->role = $request->role;
        $data->save();

        return response()->json([
                'status' => true, 
                'message' => 'Berhasil mengubah data', 
                'code' => 201
            ]);
        
        // return $arrayName = array('status' => 'OK', 'code' => 200, 'message' => 'Berhasil Mengubah Data' );

    }
}
