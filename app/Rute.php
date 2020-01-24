<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    protected $table = 'rutes';

    public function pivotBusRute()
    {
        return $this->hasMany('App\PivotBusRute');
    }
}
