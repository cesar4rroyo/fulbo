<div>
    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="tanggal_pemesanan"> Tanggal Pemesanan: </label>
            <input
                    id="tanggal_pemesanan"
                    type="date"
                    placeholder="Tanggal Pemesanan"
                    class="form-control @error("tanggal_pemesanan") is-invalid @enderror"
                    name="tanggal_pemesanan"
                    wire:model="pemesanan_data.tanggal_pemesanan"
            />
            @error("tanggal_pemesanan")
            <span class="invalid-feedback">
                {{ $message }}
            </span>
            @enderror
        </div>

        <div class="form-group">
            <div>
                Item Pemesanan:
            </div>

            <table class="table table-sm table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th> # </th>
                        <th> Waktu </th>
                        <th class="text-right"> Harga </th>
                        <th class="text-center"> Pesan? </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($item_pemesanans_data AS $index => $item_pemesanan_data)
                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            <td>
                                {{ $item_pemesanan_data["start"] }} - {{ $item_pemesanan_data["finish"] }}

                                <input
                                        name="item_pemesanan_data[{{ $index  }}][start]"
                                        wire:model="item_pemesanans_data.{{ $index }}.start"
                                        type="hidden">

                                <input
                                        name="item_pemesanan_data[{{ $index  }}][finish]"
                                        wire:model="item_pemesanans_data.{{ $index }}.finish"
                                        type="hidden">
                            </td>
                            <td class="text-right"> {{ \App\Support\Formatter::currency($this->price) }} </td>
                            <td class="text-center">
                                <input
                                        name="item_pemesanan_data[{{ $index  }}][picked]"
                                        wire:model="item_pemesanans_data.{{ $index }}.picked"
                                        type="checkbox"
                                    >
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td> </td>
                        <td class="font-weight-bold text-right"> Total: </td>
                        <td class="text-right">
                            {{ \App\Support\Formatter::currency($this->totalPrice) }}
                        </td>
                        <td> </td>
                    </tr>
                </tfoot>
            </table>

            @error("item_pemesanans_data")
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>




        <div class="form-group d-flex justify-content-end">
            <button class="btn btn-lg btn-primary">
                Pesan
                <i class="fas fa-book  "></i>
            </button>
        </div>
    </form>
</div>
