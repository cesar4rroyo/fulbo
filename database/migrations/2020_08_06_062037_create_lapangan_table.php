<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLapanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lapangan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->boolean('aktif')->index();
            $table->unsignedInteger('tempat_penyewaan_id')->index();
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
        Schema::dropIfExists('lapangan');
    }
}
