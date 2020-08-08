<?php


namespace App\QueryBuilder;


use App\Enums\UserLevel;
use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    public function isPenyewa(): self
    {
        $this->where('level', UserLevel::PENYEWA);
        return $this;
    }
}
