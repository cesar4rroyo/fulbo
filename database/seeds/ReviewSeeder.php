<?php

use App\Penyewa;
use App\Review;
use App\TempatPenyewaan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
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
                factory(Review::class)->create([
                    "tempat_penyewaan_id" => $tempatPenyewaan->id,
                    "penyewa_id" => $penyewa->id,
                ]);
            }
        }

        DB::commit();
    }
}
