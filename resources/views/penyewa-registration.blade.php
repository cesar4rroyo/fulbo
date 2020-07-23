@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="card" style="width: 30rem; margin: auto">
            <div class="card-header">
                Registrasi Penyewa
            </div>
            <div class="card-body">
                <form action="{{ route("penyewa-registration") }}"
                      method="POST">
                    @csrf
                    @method("POST")

                    <div class="form-group">
                        <label for="name"> Nama Asli:</label>
                        <input
                            id="name"
                            type="text"
                            placeholder="Nama Asli"
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
                        <label for="username"> Nama Pengguna: </label>
                        <input
                            id="username"
                            type="text"
                            placeholder="Nama Pengguna"
                            class="form-control @error("username") is-invalid @enderror"
                            name="username"
                            value="{{ old("username") }}"
                        />
                        @error("username")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir"> Tanggal Lahir:</label>
                        <input
                            id="tanggal_lahir"
                            type="date"
                            placeholder="Tanggal Lahir"
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
                        <label for="password"> Kata Sandi:</label>
                        <input
                            id="password"
                            type="password"
                            placeholder="Kata Sandi"
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
                        <label for="password_confirmation"> Ulangi Kata Sandi:</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            placeholder="Ulangi Kata Sandi"
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
                            Daftar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
