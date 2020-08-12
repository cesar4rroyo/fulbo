<?php


namespace App\Support;


use Illuminate\Support\DateFactory;

class Formatter
{
    public static function currency($value)
    {
        return number_format($value);
    }

    public static function timeWithoutSeconds($value)
    {
        return app(DateFactory::class)
            ->createFromFormat("H:i:s", $value)
            ->format("H:i");
    }

    public static function date($value)
    {
        return app(DateFactory::class)
            ->make($value)
            ->format("l, d F Y");
    }
}