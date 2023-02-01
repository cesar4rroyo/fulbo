@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="feature-title">
            Perfil de la Canchita o Lugar de Alquiler
        </h1>

        @include("shared.messages")

        <div class="card">
            <div class="card-body">
                <form action="{{ route("tempat-penyewaan-profile-management") }}"
                      method="POST"
                >
                    @csrf
                    @method("PUT")

                    <h2> Identidad del lugar de alquiler </h2>
                    <hr>

                    <div class="form-group">
                        <label for="terverifikasi"> Estado de verificación: </label>
                        <select
                                disabled
                                id="terverifikasi"
                                class="form-control"
                        >
                            <option {{ $user->tempat_penyewaan->terverifikasi == 0 ? "selected" : ""  }} value="0">
                                No verificado
                            </option>
                            <option {{ $user->tempat_penyewaan->terverifikasi == 1 ? "selected" : ""  }} value="1">
                                Verificado
                            </option>
                        </select>
                    </div>

                    @if($user->tempat_penyewaan->terverifikasi == 0)
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            Las cuentas que no han sido verificadas no pueden usar las funciones completas.
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="nama"> Nombre del lugar de alquiler:</label>
                        <input
                                id="nama"
                                type="text"
                                placeholder="Nombre del lugar de alquiler"
                                class="form-control @error("nama") is-invalid @enderror"
                                name="nama"
                                value="{{ old("nama", $user->tempat_penyewaan->nama) }}"
                        />
                        @error("nama")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_telepon"> Nro. de Teléfono: </label>
                        <input
                                id="no_telepon"
                                type="tel"
                                placeholder="Nro. de Teléfono"
                                class="form-control @error("no_telepon") is-invalid @enderror"
                                name="no_telepon"
                                value="{{ old("no_telepon", $user->tempat_penyewaan->no_telepon) }}"
                        />
                        @error("no_telepon")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="waktu_buka"> Hora de Inicio: </label>
                        <input
                                id="waktu_buka"
                                type="time"
                                placeholder="Hora de Inicio"
                                class="form-control @error("waktu_buka") is-invalid @enderror"
                                name="waktu_buka"
                                value="{{ old("waktu_buka", \App\Support\Formatter::timeWithoutSeconds($user->tempat_penyewaan->waktu_buka)) }}"
                        />
                        @error("waktu_buka")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="waktu_tutup"> Hora de Cierre: </label>
                        <input
                                id="waktu_tutup"
                                type="time"
                                placeholder="Hora de Cierre"
                                class="form-control @error("waktu_tutup") is-invalid @enderror"
                                name="waktu_tutup"
                                value="{{ old("waktu_tutup", \App\Support\Formatter::timeWithoutSeconds($user->tempat_penyewaan->waktu_tutup)) }}"
                        />
                        @error("waktu_tutup")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat">
                            Dirección:
                        </label>
                        <textarea
                                class="form-control @error("alamat") is-invalid @enderror"
                                name="alamat"
                                id="alamat"
                                placeholder="Dirección"
                                cols="30"
                                rows="5"
                        >{{ old("alamat", $user->tempat_penyewaan->alamat) }}</textarea>
                        @error("alamat")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <h2> Identificación del Administrador </h2>
                    <hr>

                    <div class="form-group">
                        <label for="name"> Nombre:</label>
                        <input
                                id="name"
                                type="text"
                                placeholder="Nombre"
                                class="form-control @error("name") is-invalid @enderror"
                                name="name"
                                value="{{ old("name", $user->name) }}"
                        />
                        @error("name")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email"> E-Mail:</label>
                        <input
                                id="email"
                                type="email"
                                placeholder="E-Mail"
                                class="form-control @error("email") is-invalid @enderror"
                                name="email"
                                value="{{ old("email", $user->email) }}"
                        />
                        @error("email")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir"> Fecha de nacimiento:</label>
                        <input
                                id="tanggal_lahir"
                                type="date"
                                placeholder="Fecha de nacimiento"
                                class="form-control @error("tanggal_lahir") is-invalid @enderror"
                                name="tanggal_lahir"
                                value="{{ old("tanggal_lahir", $user->tanggal_lahir) }}"
                        />
                        @error("tanggal_lahir")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password"> Nueva Contraseña:</label>
                        <input
                                id="password"
                                type="password"
                                placeholder="Nueva Contraseña"
                                class="form-control @error("password") is-invalid @enderror"
                                name="password"
                                value="{{ old("password") }}"
                        />
                        @error("password")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation"> Confirmación de Nueva Contraseña:</label>
                        <input
                                id="password_confirmation"
                                type="password"
                                placeholder="Confirmación de Nueva Contraseña"
                                class="form-control @error("password_confirmation") is-invalid @enderror"
                                name="password_confirmation"
                                value="{{ old("password_confirmation") }}"
                        />
                        @error("password_confirmation")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary">
                            Guardar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
