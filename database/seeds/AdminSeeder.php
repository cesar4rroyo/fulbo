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
        $user = factory(User::class)->make([
            "email" => "admin@admin.com",
            "password" => Hash::make("admin"),
            "level" => UserLevel::ADMIN_UTAMA,
        ]);

        User::query()->firstOrCreate(
            $user->only(["email", "password", "level"]),
            $user->toArray(),
        );
    }
}
