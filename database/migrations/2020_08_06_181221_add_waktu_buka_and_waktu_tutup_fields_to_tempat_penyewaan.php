<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWaktuBukaAndWaktuTutupFieldsToTempatPenyewaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tempat_penyewaan', function (Blueprint $table) {
            $table->boolean('aktif')->default(0);
            $table->time('waktu_buka')->nullable();
            $table->time('waktu_tutup')->nullable();
            $table->time('panjang_sesi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tempat_penyewaan', function (Blueprint $table) {
            $table->dropColumn('aktif');
            $table->dropColumn('waktu_buka');
            $table->dropColumn('waktu_tutup');
            $table->dropColumn('panjang_sesi');
        });
    }
}
