<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fasilitas;
use Faker\Generator as Faker;

$factory->define(Fasilitas::class, function (Faker $faker) {
    return [
        "nama" => ucwords(join(" ", $faker->unique()->words))
    ];
});
