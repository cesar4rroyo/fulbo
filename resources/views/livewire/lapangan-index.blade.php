<div>
    <h1 class="feature-title">
        Lapangan
    </h1>

    @include("shared.messages")

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
            @foreach($tempatPenyewaan->lapangans AS $lapangan)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $lapangan->nama }} </td>
                    <td class="text-center">
                        <x-boolean-status
                                :status="$lapangan->aktif"
                        >
                        </x-boolean-status>
                    </td>
                    <td class="text-center">
                        <x-delete-button
                                :itemId="$lapangan->id"
                        ></x-delete-button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>