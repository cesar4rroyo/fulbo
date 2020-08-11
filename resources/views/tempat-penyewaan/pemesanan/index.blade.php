@extends("layouts.app")

@section("content")
    <livewire:pemesanan-tempat-penyewaan-index
        tempat_penyewaan_id="{{ $tempat_penyewaan->id }}"
    />
@endsection
