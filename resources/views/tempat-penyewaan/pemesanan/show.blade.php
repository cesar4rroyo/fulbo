@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        <a href="{{ route("tempat-penyewaan.pemesanan-by-tempat.index", $pemesanan->tempat_penyewaan_id) }}">
            Pemesanan
        </a>
        /
        Detail
    </h1>

    @include("shared.messages")

    <dl>
        <dt> Hari, Tanggal:</dt>
        <dd> {{ \App\Support\Formatter::date($pemesanan->tanggal) }} </dd>

        <dt> Status:</dt>
        <dt>
            <x-pemesanan-status
                    status="{{ $pemesanan->status }}"
            />
        </dt>
    </dl>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="thead-dark">
            <tr>
                <th> #</th>
                <th> Waktu</th>
                <th> Harga</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pemesanan->items as $item_pemesanan)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $item_pemesanan->waktu_mulai }} - {{ $item_pemesanan->waktu_selesai }} </td>
                    <td> {{ \App\Support\Formatter::currency($item_pemesanan->harga) }} </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end">
        <form
                method="POST"
                action="{{ route("pemesanan-tempat-penyewaan.update-status", $pemesanan) }}"
        >
            @csrf
            @method("PUT")


            <div class="form-group">
                <label for="status"> Status Baru: </label>
                <select class="form-control"
                        name="status"
                        id="status"
                >
                    <option value="{{ \App\Enums\PemesananStatus::BATAL }}" {{ old("status", $pemesanan->status) == \App\Enums\PemesananStatus::BATAL ? "selected" : ""  }}>
                        Batal
                    </option>
                    <option value="{{ \App\Enums\PemesananStatus::DRAFT }}" {{ old("status", $pemesanan->status) == \App\Enums\PemesananStatus::DRAFT ? "selected" : ""  }}>
                        Draft
                    </option>
                    <option value="{{ \App\Enums\PemesananStatus::DITERIMA }}" {{ old("status", $pemesanan->status) == \App\Enums\PemesananStatus::DITERIMA ? "selected" : ""  }}>
                        Diterima
                    </option>
                </select>
            </div>

            <div class="form-group d-flex justify-content-end">
                <button class="btn btn-primary">
                    Ubah
                </button>
            </div>
        </form>
    </div>
@endsection
