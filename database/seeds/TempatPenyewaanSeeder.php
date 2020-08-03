<?php

use App\Enums\UserLevel;
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
            ->each(function (TempatPenyewaan $tempatPenyewaan, $index) {
                $usernameOrPassword = "admin_penyewaan_{$index}";

                $adminPenyewaan = factory(User::class)
                    ->create([
                        "username" => $usernameOrPassword,
                        "password" => Hash::make($usernameOrPassword),
                        "level" => UserLevel::ADMIN_PENYEWA,
                    ]);

                $tempatPenyewaan->fill([
                    "admin_id" => $adminPenyewaan->id,
                ])->save();
            });

        DB::commit();
    }
}
