@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        <a href="{{ route("tempat-penyewaan.foto.index", $tempat_penyewaan) }}">
            Foto
        </a>
        /
        Tambah
    </h1>

    @include("shared.messages")

    <div class="card">
        <div class="card-body">
            <form
                    enctype="multipart/form-data"
                    action="{{ route("tempat-penyewaan.foto.store", $tempat_penyewaan) }}"
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
                    <label for="deskripsi">
                        Deskripsi:
                    </label>
                    <textarea
                            class="form-control @error("deskripsi") is-invalid @enderror"
                            name="deskripsi"
                            id="deskripsi"
                            placeholder="Deskripsi"
                            cols="30"
                            rows="5"
                    >{{ old("deskripsi") }}</textarea>
                    @error("deskripsi")
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="urutan"> Urutan: </label>
                    <input
                            id="urutan"
                            type="number"
                            placeholder="Urutan"
                            class="form-control @error("urutan") is-invalid @enderror"
                            name="urutan"
                            value="{{ old("urutan") }}"
                    />
                    @error("urutan")
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image"> Gambar Baru: </label>
                    <input
                            id="image"
                            type="file"
                            accept=".png, .jpg, .jpeg"
                            class="form-control @error("image") is-invalid @enderror"
                            name="image"
                    />
                    @error("image")
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