<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TempatPenyewaan;
use Faker\Generator as Faker;

$factory->define(TempatPenyewaan::class, function (Faker $faker) {
    return [
        'nama' => $faker->company,
        'alamat' => $faker->address,
        'terverifikasi' => rand(0, 1),
    ];
});
