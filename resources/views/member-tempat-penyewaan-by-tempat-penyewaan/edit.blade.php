@extends("layouts.guest-app")

@section("content")
    <div class="container py-3">
        <h1 class="feature-title">
            Buat Pengajuan Member
        </h1>

        <dl>
            <dt> Penyewa: </dt>
            <dd>
                <div> {{ $member_tempat_penyewaan->penyewa->user->name }} </div>
                <div> {{ $member_tempat_penyewaan->penyewa->no_telepon }} </div>
            </dd>
        </dl>

        <livewire:member-tempat-penyewaan-by-tempat-penyewaan-edit
                member_tempat_penyewaan_id="{{ $member_tempat_penyewaan->id }}"
                tempat_penyewaan_id="{{ $member_tempat_penyewaan->tempat_penyewaan_id }}"
        />
    </div>
@endsection