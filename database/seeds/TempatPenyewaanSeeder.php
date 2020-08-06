<?php

use App\Enums\UserLevel;
use App\Lapangan;
use App\TempatPenyewaan;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TempatPenyewaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        factory(TempatPenyewaan::class, rand(30, 50))
            ->make()
            ->map(function (TempatPenyewaan $tempatPenyewaan, $index) {
                $usernameOrPassword = "admin_penyewaan_{$index}";
                $email = "{$usernameOrPassword}@test.com";

                $tempatPenyewaan->admin()->associate(
                    factory(User::class)->create(
                        [
                        "email" => $email,
                        "username" => $usernameOrPassword,
                        "level" => UserLevel::ADMIN_PENYEWA,
                        "password" => Hash::make($usernameOrPassword),
                    ])
                )->save();

                return $tempatPenyewaan;
            })
            ->each(function (TempatPenyewaan $tempatPenyewaan) {
                $tempatPenyewaan->lapangans()->saveMany(
                    factory(Lapangan::class, rand(1, 5))
                        ->make()
                );
            });

        DB::commit();
    }
}
