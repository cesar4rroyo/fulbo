<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TempatPenyewaan;
use Faker\Generator as Faker;

$factory->define(TempatPenyewaan::class, function (Faker $faker) {
    $locationData = rand(0, 4) === 0
        ? []
        : [
            'latitude' => rand(-50, 50) / 1000 + config("map.center.latitude"),
            'longitude' => rand(-50, 50) / 1000 + config("map.center.longitude"),
        ];

    return array_merge([
        'nama' => $faker->company,
        'alamat' => $faker->address,
        'terverifikasi' => rand(0, 1),
        'aktif' => 1,
        'no_telepon' => $faker->phoneNumber,
        'waktu_buka' => '10:00:00',
        'waktu_tutup' => '17:00:00',
        'panjang_sesi' => '01:00:00',
    ], $locationData);
});
