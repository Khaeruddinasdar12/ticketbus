<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';

    public function jadwal()
    {
        return $this->belongsTo('App\Jadwal', 'id_jadwal');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'id_customer');
    }
}
