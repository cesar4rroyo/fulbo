@extends("layouts.app")

@section("content")
    <livewire:fasilitas-for-tempat-penyewaan-index
        tempat_penyewaan_id="{{ $tempat_penyewaan_id }}"
    />
@endsection