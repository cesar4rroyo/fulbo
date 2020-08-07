@extends("layouts.app")

@section("content")
    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="thead thead-dark">
                <tr>
                    <th> Urutan </th>
                    <th> Foto </th>
                    <th> Kendali </th>
                </tr>
            </thead>

            <tbody>
                @foreach($fotos AS $foto)
                    <tr>
                        <td> {{ $fotos->firstItem() + $loop->iteration }} </td>
                        <td>
                            <img src="{{ route("foto.thumb.show", $foto) }}"
                                 class="img-fluid rounded-top"
                                 alt="Test Test"
                            >
                        </td>
                        <td class="align-middle">
                            <a class="btn btn-info" href="{{ route("foto.edit", $foto) }}">
                                Ubah
                                <i class="fas fa-pencil-alt"></i>
                            </a>
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