<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TempatPenyewaan extends Model
{
    protected $table = "tempat_penyewaan";

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
