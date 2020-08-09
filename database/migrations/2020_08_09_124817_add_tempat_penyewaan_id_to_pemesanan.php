<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTempatPenyewaanIdToPemesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->unsignedInteger('tempat_penyewaan_id')
                ->after('penyewa_id')
                ->index();

            $table->foreign('tempat_penyewaan_id')
                ->references('id')
                ->on('tempat_penyewaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->dropForeign(['tempat_penyewaan_id']);
            $table->dropColumn('tempat_penyewaan_id');
        });
    }
}
