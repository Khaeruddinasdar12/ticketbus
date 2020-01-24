<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kursi extends Model
{
    protected $table = 'kursis';

    public function bus()
    {
        return $this->belongsTo('App\Bus', 'id_bus');
    }
}
