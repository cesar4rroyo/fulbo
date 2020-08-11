<?php


namespace App\Enums;


use App\MemberTempatPenyewaan;

class MemberTempatPenyewaanStatus
{
    const REQUESTED = "DIAJUKAN";
    const ACTIVE = "AKTIF";
    const INACTIVE = "NONAKTIF";

    const STATUSES = [
        self::REQUESTED,
        self::ACTIVE,
        self::INACTIVE,
    ];
}
