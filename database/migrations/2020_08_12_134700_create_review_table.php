<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('rating');
            $table->text('konten');
            $table->unsignedInteger('penyewa_id')->index();
            $table->unsignedInteger('tempat_penyewaan_id')->index();

            $table->unique([
                'penyewa_id',
                'tempat_penyewaan_id'
            ]);

            $table->foreign('penyewa_id')->references('id')->on('penyewa');
            $table->foreign('tempat_penyewaan_id')->references('id')->on('tempat_penyewaan');
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
        Schema::dropIfExists('review');
    }
}
