<div class="container">
    <h1 class="feature-title">
        Tempat Penyewaan
    </h1>

    @include("shared.messages")

    <div class="d-flex align-items-center">
        <div class="form-inline my-3">
            <label for="filter_items" class="mr-3">
                Filter:
            </label>

            <select
                class="form-control"
                id="filter_items"
                wire:model="selectedOption"
            >
                @foreach($options AS $option)
                    <option
                        value="{{ $option }}">
                        {{ $option }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-inline flex-fill ml-2">
            <div>
                <livewire:index-search :key="rand()"/>
            </div>
        </div>
    </div>

    @if($tempatPenyewaans->count() > 0)
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead class="thead-dark">
                <tr>
                    <th class="align-middle"> #</th>
                    <th class="align-middle"> Nama Tempat</th>
                    <th class="align-middle"> Admin</th>
                    <th class="align-middle" style="width: 100px"> Alamat</th>
                    <th class="align-middle text-center"> Status Verifikasi</th>
                    <th class="align-middle text-center"> Kendali</th>
                </tr>
                </thead>

                <tbody>
                @foreach($tempatPenyewaans AS $tempatPenyewaan)
                    <tr>
                        <td> {{ $tempatPenyewaans->firstItem() + $loop->index }} </td>
                        <td> {{ $tempatPenyewaan->nama }} </td>
                        <td>
                            <div> {{ $tempatPenyewaan->admin->name }} </div>
                            <div> ({{ $tempatPenyewaan->admin->email }}) </div>
                        </td>
                        <td> {{ $tempatPenyewaan->alamat }} </td>
                        <td class="text-center">
                            <x-boolean-status
                                :status="$tempatPenyewaan->terverifikasi">
                            </x-boolean-status>
                        </td>
                        <td class="text-center">
                            <div>
                                <x-delete-button
                                    :itemId="$tempatPenyewaan->id"
                                ></x-delete-button>
                            </div>

                            <a
                                class="btn btn-info btn-sm my-2 d-inline-block mx-auto"
                                href="{{ route("tempat-penyewaan.location.edit", $tempatPenyewaan) }}">
                                Lokasi
                                <i class="fas fa-pencil-alt  "></i>
                            </a>

                            <div class="text-center">
                                <x-verification-toggle
                                    :id="$tempatPenyewaan->id"
                                    :status="$tempatPenyewaan->terverifikasi"
                                ></x-verification-toggle>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $tempatPenyewaans->links() }}
        </div>
    @else
        @include('alert-no-data')
    @endif
</div>
