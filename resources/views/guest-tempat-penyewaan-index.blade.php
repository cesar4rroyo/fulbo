@extends("layouts.guest-app")

@section("content")
    <div class="container py-5">
        <h1 class="feature-title">
            Lugares de Alquiler
        </h1>

        @foreach(collect($tempat_penyewaans->items())->chunk(3) AS $tempat_penyewaan_chunk)
            <div class="row my-2">
                @foreach($tempat_penyewaan_chunk AS $tempat_penyewaan)
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h2 class="h4 text-primary">
                                    {{-- <a href="#"> --}}
                                    <a href="{{ route("tempat-penyewaan.page", $tempat_penyewaan)  }}">
                                        {{ $tempat_penyewaan->nama }}
                                    </a>
                                </h2>

                                <p>
                                    {{ $tempat_penyewaan->alamat }}
                                </p>

                                <dl>
                                    <dt><i class="fas fa-clock"></i> Horario de Atención </dt>
                                    <dd>{{ $tempat_penyewaan->waktu_buka }} - {{ $tempat_penyewaan->waktu_tutup }} </dd>

                                    <dt><i class="fas fa-user  "></i> Administrador </dt>
                                    <dd>{{ $tempat_penyewaan->admin->name  }}</dd>

                                    <dt><i class="fas fa-phone-alt"></i> Nro. de Teléfono </dt>
                                    <dd>{{ $tempat_penyewaan->no_telepon  }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        <div class="d-flex justify-content-center">
            {{ $tempat_penyewaans->links() }}
        </div>
    </div>
@endsection