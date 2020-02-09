<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Customer extends Controller
{
   	public function index()
   	{
   		$data = \App\User::where('role', 'customer')->select('id', 'name', 'email', 'alamat')->get();
   		return view('admin.customer', ['data' => $data]);
   	}
}
