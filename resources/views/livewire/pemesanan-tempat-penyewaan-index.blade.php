<div>
    <h1 class="feature-title">
        Reservas
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
            <option value="false"> Hasta el día</option>
        </select>
    </div>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="thead-dark">
            <tr>
                <th> # </th>
                <th> Inquilino </th>
                <th> Fecha y Hora </th>
                <th class="text-center"> Estado </th>
                <th class="text-center">
                    Acciones
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($this->pemesanans AS $pemesanan)
                <tr>
                    <td> {{ $this->pemesanans->firstItem() + $loop->index }} </td>
                    <td>
                        <span class="d-block">
                            {{ $pemesanan->penyewa->user->name }}
                        </span>
                        <span class="d-block"> ({{ $pemesanan->penyewa->no_telepon }}) </span>
                        <span class="d-block">
                            @if($pemesanan->penyewa->id === ($pemesanan->member_tempat_penyewaan->penyewa_id ?? null))
                                <span class="badge badge-primary">
                                    <i class="fas fa-star"></i>
                                    Pedidos de miembros
                                </span>
                            @endif
                        </span>
                    </td>
                    <td>
                        {{ \App\Support\Formatter::date($pemesanan->tanggal) }}
                    </td>
                    <td class="text-center">
                        @include("components.pemesanan-status", [
                            "status" => $pemesanan->status
                        ])
                    </td>
                    <td class="text-center">
                        <a
                                class="btn btn-info btn-sm"
                                href="{{ route("pemesanan-by-tempat.show", $pemesanan) }}">
                            Detalle
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $this->pemesanans->links() }}
    </div>
</div>
