@extends("layouts.app")

@section("content")
    <livewire:lapangan-index
        :tempat-penyewaan="$tempatPenyewaan->id"
    />
@endsection