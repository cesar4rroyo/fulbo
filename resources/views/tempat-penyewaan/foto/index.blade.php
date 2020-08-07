@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        Foto
    </h1>

    @include("shared.messages")

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="thead thead-dark">
            <tr>
                <th> Urutan </th>
                <th> Nama </th>
                <th> Deskripsi </th>
                <th> Foto </th>
                <th class="text-center" style="width: 200px"> Kendali</th>
            </tr>
            </thead>

            <tbody>
            @foreach($fotos AS $foto)
                <tr>
                    <td> {{ $fotos->firstItem() + $loop->iteration }} </td>
                    <td> {{ $foto->nama }} </td>
                    <td> {{ $foto->deskripsi }} </td>
                    <td>
                        <img src="{{ route("foto.thumb.show", $foto) }}"
                             class="img-fluid rounded-top"
                             alt="{{ $foto->deskripsi }}"
                        >
                    </td>
                    <td class="align-middle text-center">
                        <a class="btn btn-info btn-sm"
                           href="{{ route("foto.edit", $foto) }}"
                        >
                            Ubah
                            <i class="fas fa-pencil-alt"></i>
                        </a>

                        <form
                                x-data="{}"
                                x-ref="form"
                                class="d-inline-block"
                                action="{{ route("foto.destroy", $foto) }}"
                                method="POST"
                                x-on:submit.prevent="
                                    window.confirmDialog()
                                        .then(response => {
                                            if (!response.value) {
                                                return
                                            }
                                            $refs.form.submit()
                                        })
                                "
                        >
                            @csrf
                            @method("DELETE")
                            <button

                                    class="btn btn-danger btn-sm">
                                Hapus
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $fotos->links() }}
        </div>
    </div>
@endsection