<?php


namespace App\Enums;


class PemesananStatus
{
    const DRAFT = "DRAFT";
    const DITERIMA = "DITERIMA";
    const DITOLAK = "DITOLAK";

    const LEVELS = [
        self::DRAFT,
        self::DITERIMA,
        self::DITOLAK,
    ];
}
