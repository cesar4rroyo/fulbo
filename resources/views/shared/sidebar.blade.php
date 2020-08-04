<div>
    <span class="text-uppercase font-weight-bold">
        Manajemen
    </span>
    <hr class="mt-0">

    @can(\App\Providers\AuthServiceProvider::ACTION_VIEW_ANY, \App\TempatPenyewaan::class)
        <a href="{{ route("tempat-penyewaan.index") }}">
            Tempat Penyewaan
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_TEMPAT_PENYEWAAN_PROFILE)
        <a href="{{ route("tempat-penyewaan-profile-management") }}">
            Manajemen Profil
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_PENYEWA_PROFILE)
        <a href="{{ route("penyewa-profile-management") }}">
            Manajemen Profil
        </a>
    @endcan
</div>
