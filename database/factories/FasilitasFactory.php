<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fasilitas;
use Faker\Generator as Faker;

$factory->define(Fasilitas::class, function (Faker $faker) {
    $values = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
    return [
        "nama" => "Cancha # " . $values[rand(0, 9)] . rand(1, 100) * rand(1, 100),
    ];
});