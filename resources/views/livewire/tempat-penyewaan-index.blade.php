<div class="container">
    <div class="card">
        <div class="card-body">
            <table class="table table-sm table-striped table-bordered">
                <thead>
                <tr>
                    <th> No.</th>
                    <th> Nama</th>
                    <th> Admin</th>
                    <th> Alamat</th>
                    <th class="text-center"> Kendali</th>
                </tr>
                </thead>

                <tbody>
                @foreach($tempatPenyewaans AS $tempatPenyewaan)
                    <tr>
                        <td> {{ $tempatPenyewaans->lastItem() + $loop->index }} </td>
                        <td> {{ $tempatPenyewaan->admin->name }} </td>
                        <td> {{ $tempatPenyewaan->nama }} </td>
                        <td> {{ $tempatPenyewaan->alamat }} </td>
                        <td class="text-center">
                            <button class="btn btn-danger">
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
