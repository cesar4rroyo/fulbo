<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoTempatPenyewaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_tempat_penyewaan', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('tempat_penyewaan_id')->index();
            $table->string('nama');
            $table->text('deskripsi');
            $table->unsignedInteger('urutan')->index();
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
        Schema::dropIfExists('foto_tempat_penyewaan');
    }
}
