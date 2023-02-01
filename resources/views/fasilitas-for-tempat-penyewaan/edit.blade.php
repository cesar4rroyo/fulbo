@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        <a href="{{ route("tempat-penyewaan.fasilitas-for-tempat-penyewaan.index", $tempat_penyewaan) }}">
            Instalaciones
        </a>

        /

        Editar
    </h1>

    @include("shared.messages")

    <div class="card">
        <div class="card-body">
            <form action="{{ route("tempat-penyewaan.fasilitas-for-tempat-penyewaan.update", [$fasilitas->tempat_penyewaan_id, $fasilitas->id]) }}"
                  method="POST"
            >
                @csrf
                @method("PUT")

                <div class="form-group">
                    <label for="nama"> Nombre: </label>
                    <input
                            id="nama"
                            type="text"
                            placeholder="Nombre"
                            class="form-control @error("nama") is-invalid @enderror"
                            name="nama"
                            value="{{ old("nama", $fasilitas->nama) }}"
                    />
                    @error("nama")
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
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