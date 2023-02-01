@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="card" style="width: 30rem; margin: auto">
            <div class="card-header">
                Registro de Clientes
            </div>
            <div class="card-body">
                <form action="{{ route("penyewa-registration") }}"
                      method="POST">
                    @csrf
                    @method("POST")

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
                        <label for="no_telepon"> No. Telefono: </label>
                        <input
                                id="no_telepon"
                                type="tel"
                                placeholder="No. Telefono"
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
                        <label for="tanggal_lahir">Fecha de Nacimiento</label>
                        <input
                            id="tanggal_lahir"
                            type="date"
                            placeholder="Fecha de Nacimiento"
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
                        <label for="password_confirmation"> Repita la contraseña:</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            placeholder="Repita la contraseña"
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
