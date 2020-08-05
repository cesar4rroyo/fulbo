<?php

namespace App;

use App\QueryBuilder\TempatPenyewaanBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
