<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiJquery extends Controller
{
    public function namaBus($id) {

        $bus = \App\Bus::select('id', 'nama')
        		->where('id', $id)
        		->get();
        return $bus;
    }

    public function dataBus($id) {

        $bus = \App\Bus::findOrfail($id);
        return $bus;
    }
}
