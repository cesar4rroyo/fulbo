<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pemesanan extends Model
{
    protected $table = "pemesanan";
    protected $guarded = [];

    protected $casts = [
        "tanggal" => "date:Y-m-d"
    ];

    public function items(): HasMany
    {
        return $this->hasMany(ItemPemesanan::class);
    }

    public function tempat_penyewaan(): BelongsTo
    {
        return $this->belongsTo(TempatPenyewaan::class);
    }

    public function penyewa(): BelongsTo
    {
        return $this->belongsTo(Penyewa::class);
    }

    public function member_tempat_penyewaan(): BelongsTo
    {
        return $this->belongsTo(MemberTempatPenyewaan::class);
    }
}
