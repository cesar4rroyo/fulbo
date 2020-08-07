@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        <a href="{{ route("tempat-penyewaan.foto.index", $foto->tempat_penyewaan_id) }}">
            Foto
        </a>
        /
        Ubah
    </h1>

    @include("shared.messages")

    <div class="card">
        <div class="card-body">
            <form
                    enctype="multipart/form-data"
                    action="{{ route("foto.update", $foto) }}"
                    method="POST"
            >
                @method("PUT")
                @csrf
                <div class="form-group">
                    <label for="nama"> Nama: </label>
                    <input
                            id="nama"
                            type="text"
                            placeholder="Nama"
                            class="form-control @error("nama") is-invalid @enderror"
                            name="nama"
                            value="{{ old("nama", $foto->nama) }}"
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
                    >{{ old("deskripsi", $foto->deskripsi) }}</textarea>
                    @error("deskripsi")
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

                <div class="alert alert-info">
                    <i class="fas fa-exclamation-circle"></i>

                    Kosongkan kolom gambar baru jika Anda tidak ingin mengubah gambar yang telah ada sekarang
                </div>

                <div class="form-group">
                    <div class="h4"> Gambar Sekarang:</div>

                    <img src="{{ route("foto.image.show", $foto) }}"
                         class="img-fluid rounded-top"
                         alt="{{ $foto->deskripsi }}"
                    >
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary">
                        Ubah
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection