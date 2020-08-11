<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penyewa extends Model
{
    protected $table = "penyewa";
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function member_tempat_penyewaans(): HasMany
    {
        return $this->hasMany(MemberTempatPenyewaan::class);
    }

    public function memberships(): BelongsToMany
    {
        return $this->belongsToMany(Penyewa::class, (new MemberTempatPenyewaan)->getTable())
            ->using(MemberTempatPenyewaan::class)
            ->as(MemberTempatPenyewaan::PIVOT_ACCESSOR)
            ->withPivot(MemberTempatPenyewaan::INCLUDED_FIELDS)
            ->withTimestamps()
            ;
    }
}
