@extends("layouts.guest-app")

@section("content")
    <div class="container mt-5 vh-100">
        <div class="mb-3">
            <h1 class="feature-title">
                <span class="text-primary">
                    {{ $tempat_penyewaan->nama }}
                </span>
            </h1>

            <div class="card">
                <div class="card-body">
                    <p>
                        {{ $tempat_penyewaan->alamat }}
                    </p>

                    <dl>
                        <dt><i class="fas fa-user"></i> Waktu Operasi </dt>
                        <dd>{{ $tempat_penyewaan->waktu_buka }} - {{ $tempat_penyewaan->waktu_tutup }} </dd>

                        <dt><i class="fas fa-user  "></i> Admin </dt>
                        <dd>{{ $tempat_penyewaan->admin->name  }}</dd>

                        <dt><i class="fas fa-phone-alt"></i> No. Telepon </dt>
                        <dd>{{ $tempat_penyewaan->no_telepon  }}</dd>
                    </dl>
                </div>
            </div>

            @if($membership)
                @if ($membership->status === \App\Enums\MemberTempatPenyewaanStatus::INACTIVE)
                    <div class="alert alert-info">
                        <i class="fas fa-exclamation-circle"></i>
                        Anda telah membuat pengajuan member, mohon tunggu pengajuan Anda diterima.
                    </div>
                @endif

                @if ($membership->status === \App\Enums\MemberTempatPenyewaanStatus::ACTIVE)
                    <div class="alert alert-info">
                        Anda merupakan member dari tempat penyewaan ini.
                    </div>
                @endif
            @else
                <div class="my-2">
                    <a href="{{ route('tempat-penyewaan.member-tempat-penyewaan-by-tempat-penyewaan.create', $tempat_penyewaan) }}"
                       class="btn btn-info"
                    >
                        Ajukan Sebagai Member
                        <i class="fas fa-star"></i>
                    </a>
                </div>
            @endif

            @can(\App\Providers\AuthServiceProvider::ACTION_CREATE_PEMESANAN_PENYEWA)
                <a href="{{ route("tempat-penyewaan.pemesanan-penyewa.create", $tempat_penyewaan) }}"
                   class="btn btn-primary btn-block"
                >
                    <i class="fas fa-book"></i>
                    Buat Pemesanan
                </a>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-exclamation-circle"></i>
                    Anda hanya dapat melakukan pemesanan jika Anda telah masuk
                    dengan menggunakan akun penyewa.
                </div>
            @endcan
        </div>

        <div id="foto-carousel"
             class="carousel slide"
             data-ride="carousel"
        >
            <ol class="carousel-indicators">
                <li data-target="#foto-carousel"
                    data-slide-to="0"
                    class="active"
                ></li>
                <li data-target="#foto-carousel"
                    data-slide-to="1"
                ></li>
                <li data-target="#foto-carousel"
                    data-slide-to="2"
                ></li>
            </ol>
            <div class="carousel-inner"
                 role="listbox"
            >
                @foreach($tempat_penyewaan->fotos AS $foto)
                    <div class="carousel-item @if($loop->first) active @endif">
                        <img data-src="{{ route("foto.carousel.show", $foto) }}"
                             style="filter: brightness(80%)"
                             alt="{{ $foto->nama }}"
                             src="{{ route("foto.carousel.show", $foto) }}"
                        >
                        <div class="carousel-caption d-none d-md-block">
                            <h3> {{ $foto->nama }} </h3>
                            <p>
                                {{ $foto->deskripsi }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev"
               href="#foto-carousel"
               role="button"
               data-slide="prev"
            >
                <span class="carousel-control-prev-icon"
                      aria-hidden="true"
                ></span>
                <span class="sr-only"> Sebelumnya </span>
            </a>
            <a class="carousel-control-next"
               href="#foto-carousel"
               role="button"
               data-slide="next"
            >
                <span class="carousel-control-next-icon"
                      aria-hidden="true"
                ></span>
                <span class="sr-only"> Selanjutnya </span>
            </a>
        </div>
    </div>
@endsection