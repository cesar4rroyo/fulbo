<?php


namespace App\Enums;


class UserLevel
{
    const ADMIN_UTAMA = "ADMIN_UTAMA";
    const ADMIN_PENYEWAAN = "ADMIN_PENYEWAAN";
    const PENYEWA = "PENYEWA";

    const LEVELS = [
        self::ADMIN_UTAMA,
        self::ADMIN_PENYEWAAN,
        self::PENYEWA,
    ];
}
