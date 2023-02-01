@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        <a href="{{ route("tempat-penyewaan.harga-pemesanan.index", $harga_pemesanan->tempat_penyewaan_id) }}">
            Precios
        </a> /
        Actualizar
    </h1>

    @include("shared.messages")

    <div class="card">
        <div class="card-body">
            <form action="{{ route("harga-pemesanan.update", $harga_pemesanan) }}"
                  method="POST"
            >
                @csrf
                @method("PUT")

                <dl>
                    <dt> Día: </dt>
                    <dd> {{ \Facades\App\Support\DateUtil::getDayNameByIndex($harga_pemesanan->hari_dalam_minggu) }} </dd>
                </dl>

                <hr>

                <div class="form-group">
                    <label for="harga"> Precio: </label>
                    <input
                            id="harga"
                            type="number"
                            placeholder="Precio"
                            class="form-control @error("harga") is-invalid @enderror"
                            name="harga"
                            value="{{ old("harga", $harga_pemesanan->harga) }}"
                    />
                    @error("harga")
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-group d-flex justify-content-end">
                    <button class="btn btn-primary">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection