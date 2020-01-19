<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKursisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kursis', function (Blueprint $table) {
            $table->bigInteger('id_bus')->unsigned();
            $table->string('kursi');
            $table->enum('status', ['kosong', 'keranjang', 'proses_admin', 'terisi']);
            $table->timestamps();
            $table->foreign('id_bus')->references('id')->on('bus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kursis');
    }
}
