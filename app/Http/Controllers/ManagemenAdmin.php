<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagemenAdmin extends Controller
{
    public function index()
    {
        $data = \App\User::select('id', 'name', 'email', 'role')->get();
        // return $data;
        return view('admin.ManagemenAdmin', ['data' => $data]);
    }
}
