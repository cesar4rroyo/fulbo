@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="feature-title">
            Manajemen Profil Tempat Penyewaan
        </h1>

        @include("shared.messages")

        <div class="card">
            <div class="card-body">
                <form action="{{ route("tempat-penyewaan-profile-management") }}"
                      method="POST">
                    @csrf
                    @method("PUT")

                    <h2> Identitas Tempat Penyewaan </h2>
                    <hr>

                    <div class="form-group">
                        <label for="nama"> Nama Tempat Penyewaan:</label>
                        <input
                            id="nama"
                            type="text"
                            placeholder="Nama Tempat Penyewaan"
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
                        <label for="alamat">
                            Alamat:
                        </label>
                        <textarea
                            class="form-control @error("alamat") is-invalid @enderror"
                            name="alamat"
                            id="alamat"
                            placeholder="Alamat"
                            cols="30"
                            rows="5">{{ old("alamat", $user->tempat_penyewaan->alamat) }}</textarea>
                        @error("alamat")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <h2> Identitas Administrator </h2>
                    <hr>

                    <div class="form-group">
                        <label for="name"> Nama Asli:</label>
                        <input
                            id="name"
                            type="text"
                            placeholder="Nama Asli"
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
                        <label for="tanggal_lahir"> Tanggal Lahir:</label>
                        <input
                            id="tanggal_lahir"
                            type="date"
                            placeholder="Tanggal Lahir"
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
                        <label for="password"> Kata Sandi Baru:</label>
                        <input
                            id="password"
                            type="password"
                            placeholder="Kata Sandi Baru"
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
                        <label for="password_confirmation"> Ulangi Kata Sandi Baru:</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            placeholder="Ulangi Kata Sandi Baru"
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
                            Ubah
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
