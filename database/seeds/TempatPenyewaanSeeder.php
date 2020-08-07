<?php

use App\Enums\UserLevel;
use App\FotoTempatPenyewaan;
use App\Lapangan;
use App\TempatPenyewaan;
use App\User;
use Carbon\CarbonPeriod;
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

        factory(TempatPenyewaan::class, 10)
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
                    factory(FotoTempatPenyewaan::class, rand(5, 10))
                        ->make()
                        ->each(fn (FotoTempatPenyewaan $fotoTempatPenyewaan, $index) => $fotoTempatPenyewaan->fill(["urutan" => $index]))
                )->each(function (FotoTempatPenyewaan $fotoTempatPenyewaan) {
                    $fotoTempatPenyewaan
                        ->addMedia(
                            __DIR__ . "/../images/pexels-pixabay-50713.jpg"
                        )
                        ->preservingOriginal()
                        ->toMediaCollection();
                });
            })
            ->each(function (TempatPenyewaan $tempatPenyewaan) {
                $tempatPenyewaan->getPossibleSessions()->each(function (CarbonPeriod $possibleSession) use ($tempatPenyewaan) {
                    $tempatPenyewaan->sesi_pemesanans()->create([
                        "waktu_mulai" => $possibleSession->getStartDate()->format("H:i:s"),
                        "waktu_selesai" => $possibleSession->getEndDate()->format("H:i:s"),
                    ]);
                });
            })
            ->each(function (TempatPenyewaan $tempatPenyewaan) {
                $tempatPenyewaan->lapangans()->saveMany(
                    factory(Lapangan::class, rand(20, 50))
                        ->make()
                );
            });
        DB::commit();
    }
}
