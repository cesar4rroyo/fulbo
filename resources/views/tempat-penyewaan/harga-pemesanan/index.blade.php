@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        Precios
    </h1>

    @include("shared.messages")

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="thead thead-dark">
            <tr>
                <th> # </th>
                <th> Día </th>
                <th class="text-right"> Precio </th>
                <th class="text-center"> Control</th>
            </tr>
            </thead>

            <tbody>
            @foreach($harga_pemesanans AS $harga_pemesanan)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ \Facades\App\Support\DateUtil::getDayNameByIndex($harga_pemesanan->hari_dalam_minggu) }} </td>
                    <td class="text-right"> {{ number_format($harga_pemesanan->harga) }} </td>
                    <td class="text-center">
                        <a href="{{ route("harga-pemesanan.edit", $harga_pemesanan) }}" class="btn btn-info btn-sm">
                            Cambiar
                            <i class="fas fa-pencil-alt  "></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection