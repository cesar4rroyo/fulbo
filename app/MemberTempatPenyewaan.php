<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MemberTempatPenyewaan extends Pivot
{
    const PIVOT_ACCESSOR = "membership";

    const INCLUDED_FIELDS = [
        "id",
        "hari_dalam_minggu",
        "status",
    ];

    public $incrementing = true;
    protected $table = "member_tempat_penyewaan";

    public function penyewa(): BelongsTo
    {
        return $this->belongsTo(Penyewa::class);
    }

    public function tempat_penyewaan(): BelongsTo
    {
        return $this->belongsTo(TempatPenyewaan::class);
    }

    public function pemesanans(): HasMany
    {
        return $this->hasMany(
            Pemesanan::class,
            "member_tempat_penyewaan_id",
            "id",
        );
    }

    public function sesi_members(): HasMany
    {
        return $this->hasMany(
            SesiMember::class,
            "member_tempat_penyewaan_id",
            "id"
        );
    }
}
