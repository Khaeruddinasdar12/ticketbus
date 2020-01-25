<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_code')->unique();
            $table->bigInteger('id_jadwal')->unsigned();
            $table->bigInteger('id_customer')->unsigned();
            $table->enum('status_bayar', ['belum', 'proses_admin', 'sudah']);
            $table->string('no_kursi');
            $table->string('barcode');
            $table->enum('trip', ['n', 'y']);
            $table->string('bukti_transfer')->nullable();
            $table->timestamps();
            $table->foreign('id_jadwal')->references('id')->on('jadwals');
            $table->foreign('id_customer')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
