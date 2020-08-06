<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lapangan;
use Faker\Generator as Faker;

$factory->define(Lapangan::class, function (Faker $faker) {
    return [
        "nama" => ucfirst($faker->word()),
        "aktif" => rand(0, 1),
    ];
});
