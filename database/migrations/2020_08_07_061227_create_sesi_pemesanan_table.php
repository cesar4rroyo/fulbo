<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesiPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesi_pemesanan', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('tempat_penyewaan_id')->index();
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');

            $table->timestamps();

            $table->foreign('tempat_penyewaan_id')->references('id')->on('tempat_penyewaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sesi_pemesanan');
    }
}
