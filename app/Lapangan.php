<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lapangan extends Model
{
    protected $table = "lapangan";
    protected $guarded = [];

    public function tempat_penyewaan(): BelongsTo
    {
        return $this->belongsTo(TempatPenyewaan::class);
    }
}
