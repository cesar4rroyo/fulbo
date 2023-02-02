@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="feature-title">
            <a href="{{ route("tempat-penyewaan.index") }}">
                Canchitas
            </a>
            /
            Editar Ubicación
        </h1>

        @include("shared.messages")

        <tempat-penyewaan-location-edit
            submit_url="{{ route("tempat-penyewaan.location.update", $tempat_penyewaan) }}"
            redirect_url="{{ route("tempat-penyewaan.location.edit", $tempat_penyewaan) }}"
            :map_config='{{ json_encode(config("map")) }}'
            :tempat_penyewaan='{{ json_encode($tempat_penyewaan) }}'
            :tempat_penyewaans='{{ json_encode($tempat_penyewaans) }}'
        ></tempat-penyewaan-location-edit>
    </div>
@endsection
