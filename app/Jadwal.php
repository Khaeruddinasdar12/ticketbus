<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwals';

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    // public function rute()
    // {
    //     return $this->belongsTo('App\Rute', 'id_rute');
    // }

    public function bus()
    {
        return $this->belongsTo('App\Bus', 'id_bus');
    }

    // public function tipebus()
    // {
    //     return $this->belongsTo('App\Tipebus', 'id_tipebus');
    // }

    public function transaksi()
    {
        return $this->hasMany('App\Transaksi');
    }
}
