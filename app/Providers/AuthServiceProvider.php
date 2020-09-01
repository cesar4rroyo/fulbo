<?php

namespace App\Providers;

use App\Enums\MemberTempatPenyewaanStatus;
use App\Enums\UserLevel;
use App\MemberTempatPenyewaan;
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

    const ACTION_APPLY_MEMBERSHIP = 'apply-membership';
    const ACTION_CREATE_PEMESANAN_MEMBER = 'create-pemesanan-member';

    const ACTION_CREATE_REVIEW = 'create-review';
    const ACTION_VIEW_OWN_REVIEW = 'view-own-review';
    const ACTION_MANAGE_OWN_REVIEW = 'view-any-tempat-penyewaan-review';

    const ACTION_MANAGE_FASILITAS_TEMPAT_PENYEWAAN = 'manage-fasilitas-tempat-penyewaan';

    const ACTION_VIEW_ANY_TEMPAT_PENYEWAAN_PAGE = 'view-any-tempat-penyewaan-page';


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
            return
                $user->level === UserLevel::ADMIN_PENYEWAAN &&
                $user->tempat_penyewaan->terverifikasi;
        });

        Gate::define(self::ACTION_MANAGE_MEMBER, function (User $user) {
            return
                $user->level === UserLevel::ADMIN_PENYEWAAN &&
                $user->tempat_penyewaan->terverifikasi;
        });

        Gate::define(self::ACTION_CREATE_PEMESANAN_MEMBER, function (User $user, MemberTempatPenyewaan $memberTempatPenyewaan) {
            return
                $user->level === UserLevel::ADMIN_PENYEWAAN
                && $user->tempat_penyewaan->id === $memberTempatPenyewaan->tempat_penyewaan_id
                && $memberTempatPenyewaan->status === MemberTempatPenyewaanStatus::ACTIVE
                ;
        });

        Gate::define(self::ACTION_APPLY_MEMBERSHIP, function (User $user) {
            return $user->level == UserLevel::PENYEWA;
        });

        Gate::define(self::ACTION_CREATE_REVIEW, function (User $user, TempatPenyewaan $tempatPenyewaan) {
            return
                $user->level == UserLevel::PENYEWA
                && $tempatPenyewaan->reviews()->where([
                    "penyewa_id" => $user->penyewa->id,
                ])->count() === 0;
        });

        Gate::define(self::ACTION_MANAGE_OWN_REVIEW, function (User $user) {
            return
                $user->level === UserLevel::ADMIN_PENYEWAAN &&
                $user->tempat_penyewaan->terverifikasi;
        });

        Gate::define(self::ACTION_VIEW_ANY_TEMPAT_PENYEWAAN_PAGE, function (?User $user) {
            return true;
        });

        Gate::define(self::ACTION_MANAGE_FASILITAS_TEMPAT_PENYEWAAN, function (User $user) {
            return true
                && $user->level === UserLevel::ADMIN_PENYEWAAN
                && $user->tempat_penyewaan->terverifikasi == 1
                ;
        });

        Gate::define(self::ACTION_VIEW_OWN_REVIEW, function (User $user) {
            return $user->level === UserLevel::PENYEWA;
        });

        $this->registerPolicies();
    }
}
