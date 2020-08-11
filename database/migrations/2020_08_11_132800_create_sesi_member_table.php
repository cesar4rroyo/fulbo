<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesiMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesi_member', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('member_tempat_penyewaan_id')->index();
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');

            $table->foreign('member_tempat_penyewaan_id')
                ->references('id')
                ->on('member_tempat_penyewaan')
                ->cascadeOnDelete();

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
        Schema::dropIfExists('sesi_member');
    }
}
