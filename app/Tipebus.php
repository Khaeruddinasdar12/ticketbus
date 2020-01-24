<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipebus extends Model
{
    protected $table = 'tipebus';

    public function bus()
    {
        return $this->hasMany('App\Bus');
    }

    public function jadwal()
    {
        return $this->hasMany('App\Jadwal');
    }

    public function rute()
    {
        return $this->hasMany('App\Rute
    }
}
