@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        Miembros
    </h1>

    @include("shared.messages")

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="thead-dark">
            <tr>
                <th> #</th>
                <th> Nombre/Nro. Telefono</th>
                <th class="text-center"> Estado</th>
                <th class="text-center"> Accio4n</th>
            </tr>
            </thead>
            <tbody>
            @foreach($members AS $member)
                <tr>
                    <td> {{ $members->firstItem() + $loop->index }} </td>
                    <td>
                        <div> {{ $member->user->name }} </div>
                        <div> {{ $member->no_telepon }} </div>
                    </td>
                    <td class="text-uppercase text-center">
                        <x-membership-status
                                status="{{ $member->membership->status }}"
                        ></x-membership-status>
                    </td>
                    <td class="text-center">
                        @can(\App\Providers\AuthServiceProvider::ACTION_CREATE_PEMESANAN_MEMBER, $member->membership)
                            <a
                                    class="btn btn-info btn-sm"
                                    href="{{ route("member-tempat-penyewaan.pemesanan-by-member-tempat-penyewaan.create", $member->membership)  }}"
                            >
                                Añadir Pedido
                                <i class="fas fa-plus"></i>
                            </a>
                        @endcan

                        <a href="{{ route("member-tempat-penyewaan-by-tempat-penyewaan.edit", $member->membership)  }}"
                           class="btn btn-info btn-sm"
                        >
                            Cambiar
                            <i class="fas fa-pencil-alt  "></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex">
        {{ $members->links() }}
    </div>
@endsection