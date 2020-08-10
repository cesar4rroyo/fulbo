<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pemesanan', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('pemesanan_id')->index();
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->unsignedDouble('harga');

            $table->foreign('pemesanan_id')->references('id')
                ->on('pemesanan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_pemesanan');
    }
}
