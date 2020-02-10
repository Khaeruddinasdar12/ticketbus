<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Customer extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$data = \App\User::where('role', 'customer')->select('id', 'name', 'email', 'alamat')->get();
		return view('admin.customer', ['data' => $data]);
	}
}
