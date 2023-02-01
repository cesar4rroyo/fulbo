<?php

use App\Enums\UserLevel;
use App\Penyewa;
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

        factory(Penyewa::class, 100)
            ->make()
            ->each(function (Penyewa $penyewa, $index) {
                $emailOrPassword = "cliente_{$index}@test.com";

                $penyewa->user()->associate(
                    factory(User::class)->create([
                        "email" => $emailOrPassword,
                        "password" => Hash::make($emailOrPassword),
                        "level" => UserLevel::PENYEWA,
                    ])
                )->save();
            });

        DB::commit();
    }
}