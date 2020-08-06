@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        <a href="{{ route("tempat-penyewaan.lapangan.index", $tempatPenyewaan) }}">
            Lapangan
        </a>
        /
        Tambah
    </h1>

    @include("shared.messages")

    <div class="card">
        <div class="card-body">
            <form action="{{ route("tempat-penyewaan.lapangan.store", $tempatPenyewaan) }}"
                  method="POST"
            >
                @csrf
                <div class="form-group">
                    <label for="nama"> Nama: </label>
                    <input
                            id="nama"
                            type="text"
                            placeholder="Nama"
                            class="form-control @error("nama") is-invalid @enderror"
                            name="nama"
                            value="{{ old("nama") }}"
                    />
                    @error("nama")
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="aktif"> Aktif / Tidak Aktif: </label>
                    <select
                            id="aktif"
                            type="text"
                            class="form-control @error("aktif") is-invalid @enderror"
                            name="aktif"

                    >
                        <option {{ old("aktif") === "1" ? "selected" : "" }}  value="1"> Aktif </option>
                        <option {{ old("aktif") === "0" ? "selected" : "" }}  value="0"> Tidak Aktif </option>
                    </select>
                    @error("aktif")
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection