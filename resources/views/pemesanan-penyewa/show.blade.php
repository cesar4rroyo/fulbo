@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        <a href="{{ route("pemesanan-penyewa.index") }}">
            Reservas
        </a>
        /
        Detalles
    </h1>

    <dl>
        <dt> Lugar de Alquiler </dt>
        <dd> {{ $pemesanan->tempat_penyewaan->nama }} ({{ $pemesanan->tempat_penyewaan->no_telepon }}) </dd>

        <dt> Fecha y Hora:</dt>
        <dd> {{ \App\Support\Formatter::date($pemesanan->tanggal) }} </dd>

        <dt> Estado:</dt>
        <dt>
            <x-pemesanan-status
                    :status="$pemesanan->status"
            />
        </dt>
    </dl>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="thead-dark">
            <tr>
                <th> #</th>
                <th> Tiempo</th>
                <th> Precio</th>
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

    @if($pemesanan->status !== \App\Enums\PemesananStatus::DITERIMA)
        <div class="d-flex justify-content-end">
            <form
                    method="POST"
                    action="{{ route("pemesanan-penyewa.update-status", $pemesanan) }}"
            >
                @csrf
                @method("PUT")




                <div class="form-group">
                    <label for="status"> Nuevo Estado: </label>
                    <select class="form-control"
                            name="status"
                            id="status"
                    >
                        <option value="{{ \App\Enums\PemesananStatus::BATAL }}" {{ old("status", $pemesanan->status) === \App\Enums\PemesananStatus::BATAL ? "selected" : ""  }}>
                            Cancelado
                        </option>
                        <option value="{{ \App\Enums\PemesananStatus::DRAFT }}" {{ old("status", $pemesanan->status) === \App\Enums\PemesananStatus::DRAFT ? "selected" : ""  }}>
                            Sin Procesar
                        </option>
                    </select>
                </div>

                <div class="form-group d-flex justify-content-end">
                    <button class="btn btn-primary">
                        Cambiar
                    </button>
                </div>
            </form>
        </div>
    @endif
@endsection