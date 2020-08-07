<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FotoTempatPenyewaan;
use Faker\Generator as Faker;

$factory->define(FotoTempatPenyewaan::class, function (Faker $faker) {
    return [
        'nama' => join(' ', array_map(fn ($word) => ucfirst($word), $faker->words())),
        'deskripsi' => $faker->text(),
        'urutan' => rand(1, 100)
    ];
});
