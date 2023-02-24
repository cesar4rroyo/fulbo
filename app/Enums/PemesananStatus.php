<?php


namespace App\Enums;


class PemesananStatus
{
    const DRAFT = "SIN PROCESAR";
    const DITERIMA = "ACEPTADO";
    const BATAL = "CANCELADO";

    const LEVELS = [
        self::DRAFT,
        self::DITERIMA,
        self::BATAL,
    ];
}