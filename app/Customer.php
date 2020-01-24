<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    public function transaksi()
    {
        return $this->hasMany('App\Transaksi');
    }
}
