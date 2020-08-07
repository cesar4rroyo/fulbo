@php
    use Illuminate\Support\Facades\Route;
    use App\Providers\AuthServiceProvider;
@endphp

<div class="font-weight-bold">
    <span class="text-uppercase">
        Manajemen
    </span>
    <hr class="mt-0">

    @can(\App\Providers\AuthServiceProvider::ACTION_VIEW_ANY, \App\TempatPenyewaan::class)
        <a class="text-decoration-none d-block {{ Route::is("tempat-penyewaan.*") ? "text-primary" : "text-dark"  }}"
           href="{{ route("tempat-penyewaan.index") }}"
        >
            Tempat Penyewaan
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_TEMPAT_PENYEWAAN_PROFILE)
        <a class="text-decoration-none d-block {{ Route::is("tempat-penyewaan-profile-management") ? "text-primary" : "text-dark"  }}"
           href="{{ route("tempat-penyewaan-profile-management") }}"
        >
            Profil
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_LAPANGAN)
        <a class="text-decoration-none d-block {{ Route::is("tempat-penyewaan.lapangan.*") ? "text-primary" : "text-dark"  }}"
           href="{{ route("tempat-penyewaan.lapangan.index", auth()->user()->tempat_penyewaan) }}"
        >
            Lapangan
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_FOTO)
        <a class="text-decoration-none d-block {{ Route::is("tempat-penyewaan.foto.*") ? "text-primary" : "text-dark"  }}"
           href="{{ route("tempat-penyewaan.foto.index", auth()->user()->tempat_penyewaan) }}"
        >
            Foto
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_PENYEWA_PROFILE)
        <a class="text-decoration-none d-block {{ Route::is("penyewa-profile-management") ? "text-primary" : "text-dark"  }}"
           href="{{ route("penyewa-profile-management") }}"
        >
            Profil
        </a>
    @endcan
</div>
