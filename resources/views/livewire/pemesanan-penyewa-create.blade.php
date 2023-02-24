<div>
    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="tanggal_pemesanan"> Fecha de Reserva: </label>
            <input
                    id="tanggal_pemesanan"
                    type="date"
                    placeholder="Fecha de Reserva"
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

        <dl>
            <dt> Tiempo Abierto: </dt>
            <dd> {{ $tempat_penyewaan->waktu_buka }} </dd>
        </dl>

        <dl>
            <dt> Hora de Cierre: </dt>
            <dd> {{ $tempat_penyewaan->waktu_tutup }} </dd>
        </dl>

        <div class="form-group">
            <div>
                Items:
            </div>

            <table class="table table-sm table-striped">
                <thead class="thead-dark">
                <tr>
                    <th> #</th>
                    <th> Hora de Inicio</th>
                    <th> Tiempo de Fin</th>
                    <th class="text-right"> Total de Horas </th>
                    <th class="text-right"> Precio</th>
                    <th class="text-center"> Control</th>
                </tr>
                </thead>

                <tbody>
                @foreach($item_pemesanans_data AS $index => $item_pemesanan_data)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td>
                            <label for="start"
                                   class="w-100"
                            >
                                <input
                                        id="start"
                                        wire:key="item_pemesanans_data.{{ $index }}.start"
                                        wire:model.defer="item_pemesanans_data.{{ $index }}.start"
                                        type="time"
                                        placeholder="Hora de Inicio"
                                        class="form-control form-control-sm @error("item_pemesanans_data.{$index}.start") is-invalid @enderror"
                                        name="start"
                                        value="{{ old("start") }}"
                                />
                                @error("item_pemesanans_data.{$index}.start")
                                <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </label>
                        </td>
                        <td>
                            <label for="finish"
                                   class="w-100"
                            >
                                <input
                                        id="finish"
                                        wire:key="item_pemesanans_data.{{ $index }}.finish"
                                        wire:model.defer="item_pemesanans_data.{{ $index }}.finish"
                                        type="time"
                                        placeholder="Hora de Acabar"
                                        class="form-control form-control-sm @error("item_pemesanans_data.{$index}.finish") is-invalid @enderror"
                                        name="finish"
                                        value="{{ old("finish") }}"
                                />
                                @error("item_pemesanans_data.{$index}.finish")
                                <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </label>
                        </td>
                        <td class="text-right">
                            {{ $item_pemesanans_data[$index]["hour_diff"] }}
                        </td>

                        <td class="text-right">
                            {{ \App\Support\Formatter::currency($item_pemesanans_data[$index]["price"]) }}
                        </td>
                        <td class="text-center">
                            <button type="button"
                                    class="btn btn-danger btn-sm"
                                    wire:click="removeItemPemesananData({{ $index }})"
                            >
                                Eliminar
                            </button>
                        </td>

                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="font-weight-bold text-right"> Total:</td>
                    <td class="text-right">
                        {{ \App\Support\Formatter::currency($this->totalPrice) }}
                    </td>
                    <td></td>
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
            <button
                    wire:click="tambahItemPemesanan"
                    class="btn btn-dark btn-sm"
                    type="button"
            >
                Añadir Items
            </button>
        </div>

        <hr>

        <div class="form-group d-flex justify-content-end">
            <button class="btn btn-lg btn-primary">
                Mensaje
                <i class="fas fa-book  "></i>
            </button>
        </div>
    </form>
</div>
