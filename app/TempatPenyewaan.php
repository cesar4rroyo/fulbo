<?php

namespace App;

use App\QueryBuilder\TempatPenyewaanBuilder;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property boolean terverifikasi
 */
class TempatPenyewaan extends Model
{
    protected $table = "tempat_penyewaan";
    protected $guarded = [];

    public static function query(): TempatPenyewaanBuilder
    {
        return parent::query();
    }

    public function newEloquentBuilder($query)
    {
        return new TempatPenyewaanBuilder($query);
    }

    public function lapangans(): HasMany
    {
        return $this->hasMany(Lapangan::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPossibleSessions()
    {
        if (empty($this->waktu_buka) || empty($this->waktu_tutup) || empty($this->panjang_sesi)) {
            return [];
        }

        $openingTime = Carbon::createFromFormat("H:i:s", $this->waktu_buka);
        $closingTime = Carbon::createFromFormat("H:i:s", $this->waktu_tutup);
        $sessionLength = CarbonInterval::createFromFormat("H:i:s", $this->panjang_sesi);


//        $result = [];
//        for ($time = $openingTime; $time->lessThan($closingTime); $time = $time->add($sessionLength) ) {
//            dump($time);
//        }


//
//        dump(compact(
//            "openingTime",
//            "closingTime",
//            "sessionLength"
//        ));

    }
}
