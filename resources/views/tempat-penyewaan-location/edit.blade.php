@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="feature-title">
            <a href="{{ route("tempat-penyewaan.index") }}">
                Tempat Penyewaan
            </a>
            /
            Edit Lokasi
        </h1>

        @include("shared.messages")

        <div class="card">
            <div class="card-body">
            </div>
        </div>
    </div>
@endsection
