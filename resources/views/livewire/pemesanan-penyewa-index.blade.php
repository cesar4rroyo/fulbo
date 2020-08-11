<div>
    <h1 class="feature-title">
        Pemesanan
    </h1>

    @include("shared.messages")

    <div class="form-group">
        <label for="filter_show_all">
            Filter Tampilan:
        </label>

        <select
                wire:model="showAll"
                id="filter_show_all"
                class="form-control form-control-sm"
        >
            <option value="true"> Semua</option>
            <option value="false"> Hari ini Keatas</option>
        </select>
    </div>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="thead-dark">
            <tr>
                <th> #</th>
                <th> Tempat</th>
                <th> Hari, Tanggal</th>
                <th class="text-center"> Status</th>
                <th class="text-center">
                    Kendali
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($pemesanans AS $pemesanan)
                <tr>
                    <td> {{ $pemesanans->firstItem() + $loop->index }} </td>
                    <td> {{ $pemesanan->tempat_penyewaan->nama }}  </td>
                    <td> {{ \App\Support\Formatter::date($pemesanan->tanggal) }}  </td>
                    <td class="text-center">
                        <x-pemesanan-status
                            :status="$pemesanan->status"
                        />
                    </td>
                    <td class="text-center">
                        <a
                                class="btn btn-info btn-sm"
                                href="{{ route("pemesanan-penyewa.show", $pemesanan) }}"
                        >
                            Detail
                        </a>

                        @if($pemesanan->status === \App\Enums\PemesananStatus::DRAFT)
                            <button
                                    x-data="{ id: {{ $pemesanan->id }} }"
                                    x-on:click="
                                            confirmDialog()
                                                .then(response => {
                                                    if (!response.value) {
                                                        return
                                                    }
                                                    window.livewire.emit('cancel', id)
                                                })
                                        "
                                    class="btn btn-sm btn-danger"
                            >
                                Batalkan
                                <i class="fas fa-times"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end">
        {{ $pemesanans->links() }}
    </div>
</div>
