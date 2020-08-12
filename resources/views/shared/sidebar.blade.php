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

    @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_PEMESANAN_PENYEWAAN)
        <a class="text-decoration-none d-block {{ Route::is("*pemesanan-by-tempat.*") ? "text-primary" : "text-dark"  }}"
           href="{{ route("tempat-penyewaan.pemesanan-by-tempat.index", auth()->user()->tempat_penyewaan) }}"
        >
            Pemesanan
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_HARGA_PEMESANAN)
        <a class="text-decoration-none d-block {{ Route::is("*harga-pemesanan.*") ? "text-primary" : "text-dark"  }}"
           href="{{ route("tempat-penyewaan.harga-pemesanan.index", auth()->user()->tempat_penyewaan) }}"
        >
            Harga Pemesanan
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_MEMBER)
        <a class="text-decoration-none d-block {{ Route::is("*member-tempat-penyewaan-by-tempat-penyewaan.*") ? "text-primary" : "text-dark"  }}"
           href="{{ route("tempat-penyewaan.member-tempat-penyewaan-by-tempat-penyewaan.index", auth()->user()->tempat_penyewaan) }}"
            >
            Member
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_FOTO)
        <a class="text-decoration-none d-block {{ Route::is("*foto.*") ? "text-primary" : "text-dark"  }}"
           href="{{ route("tempat-penyewaan.foto.index", auth()->user()->tempat_penyewaan) }}"
        >
            Foto
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_VIEW_ANY_TEMPAT_PENYEWAAN_REVIEW, auth()->user()->tempat_penyewaan)
        <a class="text-decoration-none d-block {{ Route::is("*review-by-tempat-penyewaan.*") ? "text-primary" : "text-dark"  }}"
           href="{{ route("tempat-penyewaan.review-by-tempat-penyewaan.index", auth()->user()->tempat_penyewaan) }}"
        >
            Review
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_PENYEWA_PROFILE)
        <a class="text-decoration-none d-block {{ Route::is("penyewa-profile-management") ? "text-primary" : "text-dark" }}"
           href="{{ route("penyewa-profile-management") }}"
        >
            Profil
        </a>
    @endcan

    @can(\App\Providers\AuthServiceProvider::ACTION_VIEW_ANY_PEMESANAN_PENYEWA)
        <a class="text-decoration-none d-block {{ Route::is("pemesanan-penyewa.*") ? "text-primary" : "text-dark"  }}"
           href="{{ route("pemesanan-penyewa.index") }}"
        >
            Pemesanan
        </a>
    @endcan
</div>
