<?php

use App\Fasilitas;
use App\TempatPenyewaan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        TempatPenyewaan::query()
            ->get()
            ->each(function (TempatPenyewaan $tempatPenyewaan) {
                $tempatPenyewaan->fasilitas()->saveMany(
                    factory(Fasilitas::class, 30)
                        ->make()
                );
            });

        DB::commit();
    }
}
