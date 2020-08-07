<?php

use App\Enums\UserLevel;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenyewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        factory(User::class, 100)
            ->make()
            ->each(function (User $user, $index) {
                $emailOrPassword = "penyewa_{$index}@test.com";

                $user->fill([
                    "email" => $emailOrPassword,
                    "password" => Hash::make($emailOrPassword),
                    "level" => UserLevel::PENYEWA,
                ])->save();
            });

        DB::commit();
    }
}
