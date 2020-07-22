<?php

use App\Enums\UserLevel;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            "name" => "Admin Utama",
            "username" => "admin",
            "password" => Hash::make("admin"),
            "level" => UserLevel::ADMIN_UTAMA,
        ]);
    }
}
