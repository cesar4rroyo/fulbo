<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargaPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harga_pemesanan', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('tempat_penyewaan_id')->index();
            $table->unsignedSmallInteger('hari_dalam_minggu');
            $table->unsignedDouble('harga');

            $table->unique([
                "tempat_penyewaan_id",
                "hari_dalam_minggu"
            ], "tp_id-hdm-u");

            $table->timestamps();

            $table->foreign('tempat_penyewaan_id')
                ->references('id')->on('tempat_penyewaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('harga_pemesanan');
    }
}
