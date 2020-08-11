<?php

use App\Enums\MemberTempatPenyewaanStatus;
use App\MemberTempatPenyewaan;
use App\Penyewa;
use App\TempatPenyewaan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberTempatPenyewaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penyewas = Penyewa::query()->get();
        $tempatPenyewaans = TempatPenyewaan::query()->get();

        DB::beginTransaction();

        foreach ($penyewas as $penyewa) {
            foreach ($tempatPenyewaans as $tempatPenyewaan) {
                MemberTempatPenyewaan::query()->firstOrCreate([
                    "penyewa_id" => $penyewa->id,
                    "tempat_penyewaan_id" => $tempatPenyewaan->id,
                    "status" => MemberTempatPenyewaanStatus::REQUESTED,
                ], [
                    "hari_dalam_minggu" => rand(0, 6),
                ]);
            }
        }

        DB::commit();
    }
}
