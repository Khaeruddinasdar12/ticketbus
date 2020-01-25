<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_bus_rute')->unsigned();
            $table->date('tanggal');
            $table->string('jam');
            $table->enum('status', ['belum', 'perjalanan', 'selesai']);
            $table->bigInteger('created_by')->unsigned();
            $table->timestamps();
            $table->foreign('id_bus_rute')->references('id')->on('pivot_bus_rutes');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
}
