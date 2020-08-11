@extends("layouts.app")

@section("content")
    <div class="container py-3">
        <livewire:member-tempat-penyewaan-by-tempat-penyewaan-edit
                member_tempat_penyewaan_id="{{ $member_tempat_penyewaan->id }}"
                tempat_penyewaan_id="{{ $member_tempat_penyewaan->tempat_penyewaan_id }}"
        />
    </div>
@endsection