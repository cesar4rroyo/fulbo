<?php

/** @var Factory $factory */

use App\Enums\UserLevel;
use App\Penyewa;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Penyewa::class, function (Faker $faker) {
    return [
        "no_telepon" => $faker->phoneNumber,
    ];
});
