<?php


namespace App\QueryBuilder;


use Illuminate\Database\Eloquent\Builder;

class TempatPenyewaanBuilder extends Builder
{
    const COLNAME_VERIFIED = "terverifikasi";
    const COLNAME_LATITUDE = "latitude";
    const COLNAME_LONGITUDE = "longitude";

    public function isVerified()
    {
        return $this->where(self::COLNAME_VERIFIED, true);
    }

    public function hasLocation()
    {
        return $this->where(function (TempatPenyewaanBuilder $builder) {
            $builder
                ->whereNotNull(self::COLNAME_LATITUDE)
                ->whereNotNull(self::COLNAME_LONGITUDE);
        });
    }
}
