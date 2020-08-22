<?php

namespace App;

use App\Casts\TimeCast;
use App\QueryBuilder\TempatPenyewaanBuilder;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\LazyCollection;

/**
 * @property boolean $terverifikasi
 */
class TempatPenyewaan extends Model
{
    const MEMBERSHIP_PRICE_MULTIPLIER = 3;
    const WEEKDAY_DEFAULT_PRICE = 50_000;
    const WEEKEND_DEFAULT_PRICE = 75_000;

    protected $table = "tempat_penyewaan";
    protected $guarded = [];

    /** return TempatPenyewaanBuilder */
    public static function query(): TempatPenyewaanBuilder
    {
        return parent::query();
    }

    /** return TempatPenyewaanBuilder */
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

    public function sesi_pemesanans(): HasMany
    {
        return $this->hasMany(SesiPemesanan::class);
    }

    public function harga_pemesanans(): HasMany
    {
        return $this->hasMany(HargaPemesanan::class);
    }

    public function fotos(): HasMany
    {
        return $this->hasMany(FotoTempatPenyewaan::class);
    }

    public function pemesanans(): HasMany
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function fasilitas(): HasMany
    {
        return $this->hasMany(Fasilitas::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Penyewa::class, (new MemberTempatPenyewaan)->getTable())
            ->using(MemberTempatPenyewaan::class)
            ->as(MemberTempatPenyewaan::PIVOT_ACCESSOR)
            ->withPivot(MemberTempatPenyewaan::INCLUDED_FIELDS)
            ->withTimestamps()
            ;
    }

    /**
     * @return array|LazyCollection
     * @throws Exception
     */
    public function getPossibleSessions()
    {
        if (empty($this->waktu_buka) || empty($this->waktu_tutup)) {
            return LazyCollection::empty();
        }

        $serviceOpenPeriod = CarbonPeriod::between(
            Carbon::createFromFormat("H:i:s", $this->waktu_buka),
            Carbon::createFromFormat("H:i:s", $this->waktu_tutup),
        )->setDateInterval(
            CarbonInterval::createFromFormat("H:i:s", "01:00:00")
        );

        return LazyCollection::make(function () use ($serviceOpenPeriod) {
            $previous = $serviceOpenPeriod->current();
            $serviceOpenPeriod->next();

            while ($current = $serviceOpenPeriod->current()) {
                yield CarbonPeriod::between($previous, $current);
                $previous = $current;
                $serviceOpenPeriod->next();
            }
        });
    }

    public function getPossibleSessionsArray(): array
    {
        return $this->getPossibleSessions()
            ->map(function (CarbonPeriod $period) {
                return [
                    "start" => $period->getStartDate()->format("H:i:s"),
                    "finish" => $period->getEndDate()->format("H:i:s"),
                ];
            })->toArray();
    }
}
