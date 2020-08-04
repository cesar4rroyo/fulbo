<div class="container">
    <h1 class="feature-title">
        Tempat Penyewaan
    </h1>

    @include("shared.messages")

    <div class="form-group">
        <label for="filter_items">
            Filter:
        </label>

        <select
            class="form-control"
            id="filter_items">
            @foreach($options AS $option)
                <option value="{{ $option }}" {{ $selectedOption === $option ? "selected" : "" }} >
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </div>



    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th class="align-middle"> #</th>
            <th class="align-middle"> Nama</th>
            <th class="align-middle"> Admin</th>
            <th class="align-middle"> Alamat</th>
            <th class="align-middle text-center"> Status Verifikasi</th>
            <th class="align-middle text-center"> Kendali</th>
        </tr>
        </thead>

        <tbody>
        @foreach($tempatPenyewaans AS $tempatPenyewaan)
            <tr>
                <td> {{ $tempatPenyewaans->firstItem() + $loop->index }} </td>
                <td> {{ $tempatPenyewaan->admin->name }} </td>
                <td> {{ $tempatPenyewaan->nama }} </td>
                <td> {{ $tempatPenyewaan->alamat }} </td>
                <td class="text-center">
                    <x-verification-status
                        :status="$tempatPenyewaan->terverifikasi">
                    </x-verification-status>
                </td>
                <td class="text-center">
                    <x-delete-button
                        :itemId="$tempatPenyewaan->id"
                    ></x-delete-button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $tempatPenyewaans->links() }}
    </div>
</div>
