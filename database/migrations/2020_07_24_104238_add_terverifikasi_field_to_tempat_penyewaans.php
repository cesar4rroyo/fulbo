<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTerverifikasiFieldToTempatPenyewaans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tempat_penyewaan', function (Blueprint $table) {
            $table->boolean('terverifikasi')->default(0)
                ->after('admin_id')
                ->index();
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
            $table->dropColumn('terverifikasi');
        });
    }
}
