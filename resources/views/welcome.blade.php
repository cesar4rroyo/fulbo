@extends("layouts.app")

@section("content")
    <div class="container">
        <h1> Selamat Datang </h1>

        <div class="card">
            <div class="card-body">
                <a
                    class="btn btn-primary"
                    href="{{ route("penyewa-registration") }}">
                    Registrasi Akun Penyewa
                </a>
            </div>
        </div>
    </div>
@endsection
