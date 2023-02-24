@extends("layouts.guest-app")

@section("content")
    <div class="container py-3">
        <h1 class="feature-title">
            Crear una presentación de Miembro
        </h1>

        <dl>
            <dt> Lugar de Alquiler: </dt>
            <dd> {{ $tempat_penyewaan->nama }} </dd>
        </dl>

        <livewire:member-tempat-penyewaan-by-tempat-penyewaan-create
            tempat_penyewaan_id="{{ $tempat_penyewaan->id }}"
        />
    </div>
@endsection