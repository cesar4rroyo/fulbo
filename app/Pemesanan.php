<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pemesanan extends Model
{
    protected $table = "pemesanan";
    protected $guarded = [];

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
}
