<?php


namespace App\Support;


use Illuminate\Support\DateFactory;

class Formatter
{
    public static function currency($value)
    {
        return number_format($value);
    }

    public static function date($value)
    {
        return app(DateFactory::class)
            ->create($value)
            ->format("l, d F Y");
    }
}