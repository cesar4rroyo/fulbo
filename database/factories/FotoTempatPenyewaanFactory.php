<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FotoTempatPenyewaan;
use Faker\Generator as Faker;

$factory->define(FotoTempatPenyewaan::class, function (Faker $faker) {
    return [
        'nama' => 'Imagen # ' . rand(1, 100) * (rand(1, 100)),
        'deskripsi' => $faker->realText(),
        'urutan' => rand(1, 100)
    ];
});