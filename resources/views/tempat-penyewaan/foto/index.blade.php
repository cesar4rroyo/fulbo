@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        Fotos
    </h1>

    <div class="d-flex justify-content-end my-3">
        <a
                class="btn btn-primary"
                href="{{ route("tempat-penyewaan.foto.create", $tempat_penyewaan)  }}">
            Agregar
            <i class="fas fa-plus"></i>
        </a>
    </div>

    @include("shared.messages")

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="thead thead-dark">
            <tr>
                <th> Orden </th>
                <th> Nombre </th>
                <th> Descripción </th>
                <th> Imagen </th>
                <th class="text-center" style="width: 200px"> Acción</th>
            </tr>
            </thead>

            <tbody>
            @foreach($fotos AS $foto)
                <tr>
                    <td> {{ $foto->urutan }} </td>
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
                            Cambiar
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
                                Eliminar
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