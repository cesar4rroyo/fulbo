@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="card" style="width: 30rem; margin: auto">
            <div class="card-header">
                Registrasi Tempat Penyewaan
            </div>
            <div class="card-body">
                <form action="{{ route("tempat-penyewaan-registration") }}"
                      method="POST">
                    @csrf
                    @method("POST")





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
