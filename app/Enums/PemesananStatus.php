<?php


namespace App\Enums;


class PemesananStatus
{
    const DRAFT = "DRAFT";
    const DITERIMA = "DITERIMA";
    const BATAL = "BATAL";

    const LEVELS = [
        self::DRAFT,
        self::DITERIMA,
        self::BATAL,
    ];
}
