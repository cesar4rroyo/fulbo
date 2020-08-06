<div>
    <h1 class="feature-title">
        Lapangan
    </h1>

    @include("shared.messages")

    <div class="d-flex justify-content-end my-3">
        <a class="btn btn-primary"
           href="{{ route("tempat-penyewaan.lapangan.create", $tempatPenyewaan) }}"
        >
            Tambah
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="thead-dark">
            <tr>
                <th> # </th>
                <th> Nama </th>
                <th class="text-center"> Aktif </th>
                <th class="text-center"> Kendali </th>
            </tr>
            </thead>

            <tbody>
            @foreach($lapangans AS $lapangan)
                <tr>
                    <td> {{ $lapangans->firstItem() + $loop->index }} </td>
                    <td> {{ $lapangan->nama }} </td>
                    <td class="text-center">
                        <x-boolean-status
                                :status="$lapangan->aktif"
                        >
                        </x-boolean-status>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-info"
                            href="{{ route("lapangan.edit", $lapangan) }}"
                        >
                            Ubah
                            <i class="fas fa-pencil-alt"></i>
                        </a>


                        <x-delete-button
                                :itemId="$lapangan->id"
                        ></x-delete-button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $lapangans->links() }}
        </div>
    </div>
</div>