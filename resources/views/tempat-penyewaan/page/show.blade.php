@extends("layouts.guest-app")

@section("content")
    <div class="container mt-5 vh-100">
        <div class="mb-3">
            <h1 class="feature-title">
                <span class="text-primary">
                    {{ $tempat_penyewaan->nama }}
                </span>
            </h1>

            <div class="row">
                <div class="card col">
                    <div class="card-body">
                        <p>
                            {{ $tempat_penyewaan->alamat }}
                        </p>

                        <dl>
                            <dt><i class="fas fa-clock"></i> Waktu Operasi</dt>
                            <dd>{{ $tempat_penyewaan->waktu_buka }} - {{ $tempat_penyewaan->waktu_tutup }} </dd>

                            <dt><i class="fas fa-user  "></i> Admin</dt>
                            <dd>{{ $tempat_penyewaan->admin->name  }}</dd>

                            <dt><i class="fas fa-phone-alt"></i> No. Telepon</dt>
                            <dd>{{ $tempat_penyewaan->no_telepon  }}</dd>

                            <dt><i class="fas fa-building"></i> Fasilitas </dt>
                            <dd>
                                {{ $tempat_penyewaan->fasilitas->pluck("nama")->join(", ")  }}
                            </dd>

                            <dt><i class="fas fa-star"></i> Rating</dt>
                            <dd>{{ number_format($averageRating, 2) }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="col">
                    @can(\App\Providers\AuthServiceProvider::ACTION_CREATE_REVIEW, $tempat_penyewaan)
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-star"></i> Review
                            </div>

                            <div class="card-body">
                                <form id="reviewForm" action="{{ route("tempat-penyewaan.review-by-tempat-penyewaan.store", $tempat_penyewaan) }}"
                                      method="POST"
                                >
                                    @csrf
                                    @method("POST")

                                    <div class="form-group">
                                        <label for="rating"> Rating: </label>
                                        <select
                                                id="rating"
                                                type="text"
                                                class="form-control @error("rating") is-invalid @enderror"
                                                name="rating"
                                        >
                                            @foreach($ratingValues as $ratingValue => $ratingLabel)
                                                <option value="{{ $ratingValue }}" {{ old("rating") === $ratingValue ? "selected" : "" }}>
                                                    {{ $ratingValue }} ({{ $ratingLabel }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("rating")
                                        <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="konten">
                                            Komentar:
                                        </label>
                                        <textarea
                                                class="form-control @error("konten") is-invalid @enderror"
                                                name="konten"
                                                id="konten"
                                                placeholder="Komentar"
                                                cols="30"
                                                rows="3"
                                        ></textarea>
                                        @error("konten")
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </form>
                            </div>

                            <div class="card-footer text-right">
                                <button form="reviewForm" class="btn btn-primary">
                                    Tambahkan Review
                                </button>
                            </div>
                        </div>
                    @else
                        @can(\App\Providers\AuthServiceProvider::ACTION_VIEW_OWN_REVIEW)
                            <div class="card">
                                <div class="card-body">
                                    <h5> Review Anda: </h5>

                                    <dl>
                                        <dt>
                                            <i class="fas fa-star"></i>
                                            Rating ({{ $review->rating }} / 5)
                                        </dt>
                                        <dd>
                                            <div class="progress">
                                                <div class="progress-bar bg-primary"
                                                     role="progressbar"
                                                     style="width: {{ $review->rating / 5 * 100 }}%;"
                                                     aria-valuenow="{{ $review->rating }}"
                                                     aria-valuemin="1"
                                                     aria-valuemax="5"
                                                >
                                                </div>
                                            </div>
                                        </dd>

                                        <dt>
                                            Komentar
                                        </dt>

                                        <dd>
                                            {{ $review->konten }}
                                        </dd>

                                    </dl>
                                </div>

                                <div class="card-footer text-right">
                                    <form action="{{ route("review-by-tempat-penyewaan.destroy", $review) }}"
                                          method="POST"
                                    >
                                        @csrf
                                        @method("DELETE")

                                        <button class="btn btn-sm btn-outline-danger">
                                            Hapus Review
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        @endcan
                    @endcan

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
                            @can(\App\Providers\AuthServiceProvider::ACTION_APPLY_MEMBERSHIP)
                                <div class="my-2">
                                    <a href="{{ route('tempat-penyewaan.member-tempat-penyewaan-by-tempat-penyewaan.create', $tempat_penyewaan) }}"
                                       class="btn btn-primary btn-block"
                                    >
                                        <i class="fas fa-star"></i>
                                        Ajukan Sebagai Member
                                    </a>
                                </div>
                            @endcan
                        @endif

                        <div class="my-2">
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
                </div>
            </div>


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