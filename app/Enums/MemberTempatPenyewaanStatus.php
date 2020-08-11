<?php


namespace App\Enums;


class MemberTempatPenyewaanStatus
{
    const REQUESTED = "DIAJUKAN";
    const ACTIVE = "AKTIF";
    const INACTIVE = "NONAKTIF";

    const LEVELS = [
        self::REQUESTED,
        self::ACTIVE,
        self::INACTIVE,
    ];
}
