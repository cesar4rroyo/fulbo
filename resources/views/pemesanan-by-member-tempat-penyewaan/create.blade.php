@extends("layouts.app")

@section("content")
    <div class="container py-3">
        <livewire:pemesanan-by-member-tempat-penyewaan-create
            member_tempat_penyewaan_id="{{ $member_tempat_penyewaan->id }}"
        />
    </div>
@endsection