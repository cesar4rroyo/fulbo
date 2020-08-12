<?php


namespace App\Enums;


class MemberTempatPenyewaanStatus
{
    const ACTIVE = "AKTIF";
    const INACTIVE = "NONAKTIF";

    const STATUSES = [
        self::ACTIVE,
        self::INACTIVE,
    ];
}
