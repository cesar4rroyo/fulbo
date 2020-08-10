<?php


namespace App\QueryBuilder;


use App\Enums\UserLevel;
use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    public function isPenyewa(): self
    {
        return $this
            ->where('level', UserLevel::PENYEWA);
    }

    public function isAdminPenyewaan(): self
    {
        return $this
            ->where('level', UserLevel::ADMIN_PENYEWAAN);
    }
}
