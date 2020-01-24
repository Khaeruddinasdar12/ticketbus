<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = 'bus';

    public function jadwal()
    {
        return $this->hasMany('App\Jadwal');
    }

    public function kursi()
    {
        return $this->hasMany('App\Kursi');
    }

    public function pivotBusRute()
    {
        return $this->hasMany('App\PivotBusRute');
    }

    public function tipebus()
    {
        return $this->belongsTo('App\Tipebus', 'id_tipebus');
    }
}
