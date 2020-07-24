<?php

/** @var Factory $factory */

use App\Enums\UserLevel;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $usernameOrPassword = $faker->unique()->userName;

    return [
        'name' => $faker->name,
        'username' => $usernameOrPassword,
        'level' => $faker->randomElement(UserLevel::LEVELS),
        'email' => "{$usernameOrPassword}@gmail.com",
        'email_verified_at' => now(),
        'password' => Hash::make($usernameOrPassword), // password
        'remember_token' => Str::random(10),
    ];
});
