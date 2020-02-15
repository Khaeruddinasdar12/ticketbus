<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
class ManagemenAdmin extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = \App\User::select('id', 'name', 'email', 'role', 'alamat')->where('role', 'superadmin')->orWhere('role', 'kernet')->get();

        return view('admin.ManagemenAdmin', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validasi = $this->validate($request, [
            'name'      => 'required|min:2',
            'username'  => 'required|unique:users',
            'password'  => 'required',
            'email'     => 'required|email|unique:users',
            'role'      => 'required',
            'alamat'    => 'required'
        ],[
            'name.required'     => 'name field tidak boleh kosong',
            'username.required' => 'username field tidak boleh kosong',
            'password.required' => 'password field tidak boleh kosong',
            'email.required'    => 'email field tidak boleh kosong',
            'role.required'     => 'role field tidak boleh kosong',
            'alamat.required'   => 'alamat field tidak boleh kosong',
            'username.unique'   => 'username sudah ada',
            'email.email'       => 'email field harus format email',
            'email.unique'      => 'email sudah ada',
            'alamat.unique'     => 'email sudah ada'
            
        ]);

        $data 			= new \App\User();
        $data->name 	= $request->name;
        $data->username = $request->username;
        $data->jkel     = $request->jkel;
        $data->password = bcrypt($request->password);
        $data->email 	= $request->email;
        $data->role 	= $request->role;
        $data->alamat 	= $request->alamat;
        $data->save();

        return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menambah Data');
    }
}
