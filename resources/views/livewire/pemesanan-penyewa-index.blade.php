<div>
    <h1 class="feature-title">
        Reserva
    </h1>

    @include("shared.messages")

    <div class="form-group">
        <label for="filter_show_all">
            Ver filtros:
        </label>

        <select
                wire:model="showAll"
                id="filter_show_all"
                class="form-control form-control-sm"
        >
            <option value="true"> Todos</option>
            <option value="false"> Hasta el dia</option>
        </select>
    </div>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="thead-dark">
            <tr>
                <th> #</th>
                <th> Lugar</th>
                <th> Fecha y Hora</th>
                <th class="text-center"> Estado</th>
                <th class="text-center">
                    Acciones
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
                            Detalle
                        </a>
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
