@extends("layouts.guest-app")

@section("content")
    <div class="container py-3">
        <h1 class="feature-title">
            <a href="{{ route("tempat-penyewaan.page", $tempat_penyewaan) }}">
                {{ $tempat_penyewaan->nama }}
            </a>
            /
            Crear Reserva
        </h1>

        <div class="card" id="app">
            <div class="card-body">
                <livewire:pemesanan-penyewa-create
                    :id_tempat_penyewaan="$tempat_penyewaan->id"
                />
            </div>
        </div>
    </div>
@endsection