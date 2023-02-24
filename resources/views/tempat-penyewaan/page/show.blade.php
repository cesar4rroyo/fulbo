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
                            <dt><i class="fas fa-clock"></i> Horario de Atención</dt>
                            <dd>{{ $tempat_penyewaan->waktu_buka }} - {{ $tempat_penyewaan->waktu_tutup }} </dd>

                            <dt><i class="fas fa-user  "></i> Admin</dt>
                            <dd>{{ $tempat_penyewaan->admin->name  }}</dd>

                            <dt><i class="fas fa-phone-alt"></i> Nro. Telefono</dt>
                            <dd>{{ $tempat_penyewaan->no_telepon  }}</dd>

                            <dt><i class="fas fa-building"></i> Instalaciones </dt>
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
                                            Comentarios:
                                        </label>
                                        <textarea
                                                class="form-control @error("konten") is-invalid @enderror"
                                                name="konten"
                                                id="konten"
                                                placeholder="Comentarios"
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
                                    Agregar Reseñas
                                </button>
                            </div>
                        </div>
                    @else
                        @can(\App\Providers\AuthServiceProvider::ACTION_VIEW_OWN_REVIEW)
                            <div class="card">
                                <div class="card-body">
                                    <h5> Tu reseña:</h5>

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
                                            Comentario
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
                                            Eliminar reseñas
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
                                    Ha realizado una solicitud de miembro, espere a que se reciba su solicitud.
                                </div>
                            @endif

                            @if ($membership->status === \App\Enums\MemberTempatPenyewaanStatus::ACTIVE)
                                <div class="alert alert-info">
                                    Eres miembro de este lugar de alquiler.
                                </div>
                            @endif
                        @else
                            @can(\App\Providers\AuthServiceProvider::ACTION_APPLY_MEMBERSHIP)
                                <div class="my-2">
                                    <a href="{{ route('tempat-penyewaan.member-tempat-penyewaan-by-tempat-penyewaan.create', $tempat_penyewaan) }}"
                                       class="btn btn-primary btn-block"
                                    >
                                        <i class="fas fa-star"></i>
                                        Aplicar como miembro
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
                                    Hacer Reserva
                                </a>
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-exclamation-circle"></i>
                                    Solo puede realizar un pedido si ha iniciado sesión
                                     utilizando la cuenta del inquilino.
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
                             src="https://elcomercio.pe/resizer/2d6h-K5Kf_VKzyfPAHJ0rbINK-4=/980x0/smart/filters:format(jpeg):quality(75)/arc-anglerfish-arc2-prod-elcomercio.s3.amazonaws.com/public/YLGMR2KY7JH3BNR6Y5QVTVGZEE.jpg"
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
                <span class="sr-only"> Anterior </span>
            </a>
            <a class="carousel-control-next"
               href="#foto-carousel"
               role="button"
               data-slide="next"
            >
                <span class="carousel-control-next-icon"
                      aria-hidden="true"
                ></span>
                <span class="sr-only"> Próximo </span>
            </a>
        </div>
    </div>
@endsection