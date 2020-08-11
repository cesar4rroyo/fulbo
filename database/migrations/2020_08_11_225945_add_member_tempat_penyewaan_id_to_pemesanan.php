<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMemberTempatPenyewaanIdToPemesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->unsignedInteger('member_tempat_penyewaan_id')->index()->nullable();
            $table->foreign('member_tempat_penyewaan_id')->references('id')
                ->on('member_tempat_penyewaan');
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
            $table->dropForeign(['member_tempat_penyewaan_id']);
            $table->dropColumn('member_tempat_penyewaan_id');
        });
    }
}
