<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTempatPenyewaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_tempat_penyewaan', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('penyewa_id')->index();
            $table->foreign('penyewa_id')->references('id')->on('penyewa');
            $table->unsignedInteger('tempat_penyewaan_id')->index();
            $table->string('status')->index();

            $table->unsignedSmallInteger('hari_dalam_minggu')->comment(
                "Berisi 0 - 6, melambangkan hari dalam Minggu. Hari Minggu = 0, Senin = 1, ... , Sabtu = 6"
            );

            $table->timestamps();

            $table->unique([
                "penyewa_id",
                "tempat_penyewaan_id"
            ], "pid_tpid_uk");

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
        Schema::dropIfExists('member_tempat_penyewaan');
    }
}
