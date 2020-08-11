<?php

namespace App\Observers;

use App\TempatPenyewaan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TempatPenyewaanObserver
{
    /**
     * Handle the tempat penyewaan "created" event.
     *
     * @param  TempatPenyewaan  $tempatPenyewaan
     * @return void
     */
    public function created(TempatPenyewaan $tempatPenyewaan)
    {
        DB::beginTransaction();

        foreach (Carbon::getDays() as $index => $dayName) {
            $tempatPenyewaan->harga_pemesanans()
                ->firstOrCreate([
                    "hari_dalam_minggu" => $index,
                ], [
                    "harga" => Carbon::create()->weekday($index)->isWeekday() ?
                        TempatPenyewaan::WEEKDAY_DEFAULT_PRICE :
                        TempatPenyewaan::WEEKEND_DEFAULT_PRICE
                ]);
        }

        DB::commit();
    }

    public function updated(TempatPenyewaan $tempatPenyewaan)
    {
        dump($tempatPenyewaan->toArray());
    }
}
