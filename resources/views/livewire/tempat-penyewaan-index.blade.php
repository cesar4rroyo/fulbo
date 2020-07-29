<div class="container">
    @include("shared.messages")

    <div class="card">
        <div class="card-body">
            <table class="table table-sm table-striped table-bordered">
                <thead>
                <tr>
                    <th> # </th>
                    <th> Nama </th>
                    <th> Admin </th>
                    <th> Alamat </th>
                    <th> Aktif </th>
                    <th class="text-center"> Kendali</th>
                </tr>
                </thead>

                <tbody>
                @foreach($tempatPenyewaans AS $tempatPenyewaan)
                    <tr>
                        <td> {{ $tempatPenyewaans->firstItem() + $loop->index }} </td>
                        <td> {{ $tempatPenyewaan->admin->name }} </td>
                        <td> {{ $tempatPenyewaan->nama }} </td>
                        <td> {{ $tempatPenyewaan->alamat }} </td>
                        <td>  </td>
                        <td class="text-center">
                            <button
                                x-data="{}"
                                x-on:click="
                                    Swal.fire({
                                        title: 'Konfirmasi',
                                        text: 'Anda yakin?',
                                        icon: 'warning',
                                        showCancelButton: true,
                                    }).then(response => {
                                        if (!response.value) {
                                            return
                                        }

                                        window.livewire.emit('delete', {{ $tempatPenyewaan->id }})
                                    })
                                "
                                class="btn btn-danger">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $tempatPenyewaans->links() }}
            </div>
        </div>
    </div>
</div>
