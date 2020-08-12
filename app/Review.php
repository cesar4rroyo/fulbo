<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $table = "review";
    protected $guarded = [];

    public function penyewa(): BelongsTo
    {
        return $this->belongsTo(Penyewa::class);
    }
}
