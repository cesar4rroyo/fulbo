@extends("layouts.app")

@section("content")
    <livewire:lapangan-index
        :tempat-penyewaan-id="$tempatPenyewaan->id"
    />
@endsection