<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PivotBusRute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_bus_rutes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_bus')->unsigned();
            $table->bigInteger('id_rute')->unsigned();
            $table->timestamps();
            $table->foreign('id_bus')->references('id')->on('bus');
            $table->foreign('id_rute')->references('id')->on('rutes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivot_bus_rutes');
    }
}
