<?php

namespace App;

use App\Enums\UserLevel;
use App\QueryBuilder\UserBuilder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property TempatPenyewaan $tempat_penyewaan
 * @property string $level
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** return QueryBuilder|UserBuilder */
    public static function query()
    {
        return parent::query();
    }

    public function newEloquentBuilder($query)
    {
        return new UserBuilder($query);
    }

    public function tempat_penyewaan(): HasOne
    {
        return $this->hasOne(TempatPenyewaan::class, "admin_id");
    }

    public function penyewa(): HasOne
    {
        return $this->hasOne(Penyewa::class);
    }
}
