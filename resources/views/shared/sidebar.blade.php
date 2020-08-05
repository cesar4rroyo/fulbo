@php
    use Illuminate\Support\Facades\Route;
@endphp

<div class="font-weight-bold">
    <span class="text-uppercase">
        Manajemen
    </span>
    <hr class="mt-0">

    @can(\App\Providers\AuthServiceProvider::ACTION_VIEW_ANY, \App\TempatPenyewaan::class)
        <a class="text-decoration-none {{ Route::is("tempat-penyewaan.*") ? "text-primary" : "text-dark"  }}" href="{{ route("tempat-penyewaan.index") }}">
            Tempat Penyewaan
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_TEMPAT_PENYEWAAN_PROFILE)
        <a class="text-decoration-none {{ Route::is("tempat-penyewaan.*") ? "text-primary" : "text-dark"  }}" href="{{ route("tempat-penyewaan-profile-management") }}">
            Manajemen Profil
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_PENYEWA_PROFILE)
        <a class="text-decoration-none {{ Route::is("tempat-penyewaan.*") ? "text-primary" : "text-dark"  }}" href="{{ route("penyewa-profile-management") }}">
            Manajemen Profil
        </a>
    @endcan
</div>
