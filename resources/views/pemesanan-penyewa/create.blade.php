@extends("layouts.guest-app")

@section("content")
    <div class="container py-3">
        <h1 class="feature-title">
            <a href="{{ route("tempat-penyewaan.page", $tempat_penyewaan) }}">
                {{ $tempat_penyewaan->nama }}
            </a>
            /
            Buat Pemesanan
        </h1>

        <div class="card" id="app">
            <div class="card-body">
                <pemesanan-penyewa-create
                        submit_url='{{ route("tempat-penyewaan.pemesanan-penyewa.store", $tempat_penyewaan) }}'
                        redirect_url='{{ route("tempat-penyewaan.pemesanan-penyewa.index", $tempat_penyewaan)  }}'
                        :tempat_penyewaan='{{ json_encode($tempat_penyewaan) }}'
                        :possible_sessions='{{ json_encode($possible_sessions) }}'
                ></pemesanan-penyewa-create>
            </div>
        </div>
    </div>


@endsection