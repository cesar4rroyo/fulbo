<div>
    <h1 class="feature-title">
        Fasilitas
    </h1>

    @include("shared.messages")

    <div class="d-flex justify-content-end my-3">
        <a href="{{ route("tempat-penyewaan.fasilitas-for-tempat-penyewaan.create", $this->tempatPenyewaanId) }}" class="btn btn-primary">
            Tambah
            <i class="fas fa-plus  "></i>
        </a>
    </div>

    @if($this->fasilitasList->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-sm table-striped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th> # </th>
                    <th> Nama </th>
                    <th class="text-center"> Kendali </th>
                </tr>
                </thead>

                <tbody>
                @foreach ($this->fasilitasList as $fasilitas)
                <tr>
                    <td> {{ $this->fasilitasList->firstItem() + $loop->index }} </td>
                    <td> {{ $fasilitas->nama }} </td>
                    <td class="text-center">
                        <a href="{{ route("tempat-penyewaan.fasilitas-for-tempat-penyewaan.edit", [$this->tempatPenyewaan, $fasilitas]) }}" class="btn btn-sm btn-primary">
                            Ubah
                            <i class="fas fa-pencil-alt  "></i>
                        </a>

                        <button
                                x-data="{}"
                                x-on:click="window.confirmDialog()
                                .then(response => {
                                    if (response.value) {
                                        window.livewire.emit('fasilitas:delete', {{ $fasilitas->id }})
                                    }
                                })
"
                                class="btn btn-sm btn-danger">
                            Hapus
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $this->fasilitasList->links() }}
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            {{ __("messages.no_data") }}
        </div>
    @endif
</div>
