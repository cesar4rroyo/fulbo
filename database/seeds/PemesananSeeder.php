<?php

use App\Enums\PemesananStatus;
use App\Pemesanan;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penyewas = \App\Penyewa::query()
            ->get();

        $tempat_penyewaans = \App\TempatPenyewaan::query()
            ->get();

        $period = CarbonPeriod::between(
            Carbon::today()->addDays(-rand(3 * 30, 4 * 30)),
            Carbon::today()->addDays(+rand(3 * 30, 4 * 30))
        );

        DB::beginTransaction();

        foreach ($period as $day) {
            factory(Pemesanan::class, 5)
                ->make()
                ->each(function (Pemesanan $pemesanan) use ($tempat_penyewaans, $penyewas, $day) {
                    /** @var \App\TempatPenyewaan $tempat_penyewaan */
                    $tempat_penyewaan = $tempat_penyewaans->random();

                    $pemesanan->forceFill([
                        "tanggal" => $day,
                        "penyewa_id" => $penyewas->random()->id,
                        "tempat_penyewaan_id" => $tempat_penyewaan->id,
                        "status" => PemesananStatus::DRAFT,
                    ])->save();

                    $hargaPemesanans = $tempat_penyewaan->harga_pemesanans()
                        ->pluck("harga", "hari_dalam_minggu");

                    $max = 2;
                    $count = $tempat_penyewaan->getPossibleSessions()->count();
                    $skip = rand(0, min(0, $count - 1));
                    $take = rand(1, min($max, $count - $skip));

                    $tempat_penyewaan->getPossibleSessions()
                        ->skip($skip)
                        ->take($take)
                        ->each(function (CarbonPeriod $carbonPeriod) use ($hargaPemesanans, $day, $pemesanan) {
                            $pemesanan->items()->create([
                                "waktu_mulai" => $carbonPeriod->getStartDate()->format("H:i:s"),
                                "waktu_selesai" => $carbonPeriod->getEndDate()->format("H:i:s"),
                                "harga" => $hargaPemesanans->get($day->weekday(), 0)
                            ]);
                        });
                });
        };

        DB::commit();
    }
}
