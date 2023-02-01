@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        <a href="{{ route("tempat-penyewaan.foto.index", $foto->tempat_penyewaan_id) }}">
            Fotos
        </a>
        /
        Editar
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
                    <label for="nama"> Nombre: </label>
                    <input
                            id="nama"
                            type="text"
                            placeholder="Nombre"
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
                        Descripción:
                    </label>
                    <textarea
                            class="form-control @error("deskripsi") is-invalid @enderror"
                            name="deskripsi"
                            id="deskripsi"
                            placeholder="Descripción"
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
                    <label for="urutan"> Orden: </label>
                    <input
                            id="urutan"
                            type="number"
                            placeholder="Orden"
                            class="form-control @error("urutan") is-invalid @enderror"
                            name="urutan"
                            value="{{ old("urutan", $foto->urutan) }}"
                    />
                    @error("urutan")
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image"> Nuevas Fotos: </label>
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

                    Deje el campo de la nueva imagen en blanco si no desea cambiar la imagen existente
                </div>

                <div class="form-group">
                    <div class="h4"> Imagen:</div>

                    <img src="{{ route("foto.image.show", $foto) }}"
                         class="img-fluid rounded-top"
                         alt="{{ $foto->deskripsi }}"
                    >
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection