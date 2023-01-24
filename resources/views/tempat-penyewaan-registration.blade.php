@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="card"
             style="max-width: 50rem; margin: auto">
            <div class="card-header">
                Registro de lugar de alquiler
            </div>
            <div class="card-body">
                <form action="{{ route("tempat-penyewaan-registration") }}"
                      method="POST">
                    @csrf
                    @method("POST")

                    <h2> Identidad del lugar de alquiler </h2>
                    <hr>

                    <div class="form-group">
                        <label for="nama"> Nombre del lugar de alquiler:</label>
                        <input
                            id="nama"
                            type="text"
                            placeholder="Nombre del lugar de alquiler"
                            class="form-control @error("nama") is-invalid @enderror"
                            name="nama"
                            value="{{ old("nama") }}"
                        />
                        @error("nama")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_telepon"> Nro. Telefono: </label>
                        <input
                                id="no_telepon"
                                type="tel"
                                placeholder="Nro. Telefono"
                                class="form-control @error("no_telepon") is-invalid @enderror"
                                name="no_telepon"
                                value="{{ old("no_telepon") }}"
                        />
                        @error("no_telepon")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="waktu_buka"> Atiende desde: </label>
                        <input
                                id="waktu_buka"
                                type="time"
                                placeholder="Atiende desde"
                                class="form-control @error("waktu_buka") is-invalid @enderror"
                                name="waktu_buka"
                                value="{{ old("waktu_buka") }}"
                        />
                        @error("waktu_buka")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="waktu_tutup"> Atiende hasta: </label>
                        <input
                                id="waktu_tutup"
                                type="time"
                                placeholder="Atiende hasta"
                                class="form-control @error("waktu_tutup") is-invalid @enderror"
                                name="waktu_tutup"
                                value="{{ old("waktu_tutup") }}"
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
                            rows="5">{{ old("alamat") }}</textarea>
                        @error("alamat")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <h2> Identificación del administrador </h2>
                    <hr>

                    <div class="form-group">
                        <label for="name"> Nombres:</label>
                        <input
                            id="name"
                            type="text"
                            placeholder="Nombres"
                            class="form-control @error("name") is-invalid @enderror"
                            name="name"
                            value="{{ old("name") }}"
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
                            value="{{ old("email") }}"
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
                            value="{{ old("tanggal_lahir") }}"
                        />
                        @error("tanggal_lahir")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password"> Contraseña:</label>
                        <input
                            id="password"
                            type="password"
                            placeholder="Contraseña"
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
                        <label for="password_confirmation"> Repita Contraseña:</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            placeholder="Repita Contraseña"
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
