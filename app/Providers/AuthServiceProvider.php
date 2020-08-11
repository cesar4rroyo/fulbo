<?php

namespace App\Providers;

use App\Enums\UserLevel;
use App\Policies\TempatPenyewaanPolicy;
use App\TempatPenyewaan;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    const ACTION_VIEW_ANY = "viewAny";
    const ACTION_MANAGE_TEMPAT_PENYEWAAN_PROFILE = "manage-tempat-penyewaan-profile";
    const ACTION_MANAGE_PENYEWA_PROFILE = "penyewa-profile";
    const ACTION_MANAGE_LAPANGAN = "manage-lapangan";
    const ACTION_MANAGE_FOTO = "manage-foto";
    const ACTION_MANAGE_HARGA_PEMESANAN = "manage-harga-pemesanan";
    const ACTION_VIEW_TEMPAT_PENYEWAAN_PAGE = 'view-tempat-penyewaan';

    const ACTION_CREATE_PEMESANAN_PENYEWA = 'create-pemesanan-penyewa';
    const ACTION_UPDATE_PEMESANAN_PENYEWA = 'update-pemesanan-penyewa';
    const ACTION_VIEW_ANY_PEMESANAN_PENYEWA = 'view-any-pemesanan-penyewa';

    const ACTION_MANAGE_PEMESANAN_PENYEWAAN = 'manage-pemesanan-penyewaan';
    const ACTION_MANAGE_MEMBER = 'manage-member';

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         TempatPenyewaan::class => TempatPenyewaanPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define(self::ACTION_MANAGE_TEMPAT_PENYEWAAN_PROFILE, function (User $user) {
            return $user->level === UserLevel::ADMIN_PENYEWAAN;
        });

        Gate::define(self::ACTION_MANAGE_PENYEWA_PROFILE, function (User $user) {
            return $user->level === UserLevel::PENYEWA;
        });

        Gate::define(self::ACTION_MANAGE_LAPANGAN, function (User $user) {
            return
                $user->level === UserLevel::ADMIN_PENYEWAAN &&
                $user->tempat_penyewaan->terverifikasi;
        });

        Gate::define(self::ACTION_MANAGE_FOTO, function (User $user) {
            return
                $user->level === UserLevel::ADMIN_PENYEWAAN &&
                $user->tempat_penyewaan->terverifikasi;
        });

        Gate::define(self::ACTION_MANAGE_HARGA_PEMESANAN, function (User $user) {
            return
                $user->level === UserLevel::ADMIN_PENYEWAAN &&
                $user->tempat_penyewaan->terverifikasi;
        });

        Gate::define(self::ACTION_VIEW_TEMPAT_PENYEWAAN_PAGE, function (?User $user) {
            return $user !== null;
        });

        Gate::define(self::ACTION_CREATE_PEMESANAN_PENYEWA, function (User $user) {
            return $user->level === UserLevel::PENYEWA;
        });

        Gate::define(self::ACTION_VIEW_ANY_PEMESANAN_PENYEWA, function (User $user) {
            return $user->level === UserLevel::PENYEWA;
        });

        Gate::define(self::ACTION_UPDATE_PEMESANAN_PENYEWA, function (User $user) {
            return $user->level === UserLevel::PENYEWA;
        });

        Gate::define(self::ACTION_MANAGE_PEMESANAN_PENYEWAAN, function (User $user) {
            return $user->level === UserLevel::ADMIN_PENYEWAAN;
        });

        Gate::define(self::ACTION_MANAGE_MEMBER, function (User $user) {
            return $user->level == UserLevel::ADMIN_PENYEWAAN;
        });

        $this->registerPolicies();
    }
}
