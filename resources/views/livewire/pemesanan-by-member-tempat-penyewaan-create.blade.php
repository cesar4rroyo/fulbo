<div>
    <h1 class="feature-title">
        Tambah Pemesanan Member
    </h1>

    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="startDate"> Tanggal Mulai: </label>
            <input
                    wire:model="startDate"
                    disabled
                    id="startDate"
                    type="date"
                    placeholder="Tanggal Mulai"
                    class="form-control @error("startDate") is-invalid @enderror"
                    name="startDate"
            />
            @error("startDate")
            <span class="invalid-feedback">
                {{ $message }}
            </span>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <button
                    type="button"
                    wire:click="rewindDate"
                    class="btn btn-danger btn-sm">
                <i class="fas fa-minus  "></i>
                1 Minggu
            </button>

            <button
                    type="button"
                    wire:click="forwardDate"
                    class="btn btn-success btn-sm">
                <i class="fas fa-plus  "></i>
                1 Minggu
            </button>
        </div>

        <div class="my-3">
            <div class="h5">
                Tanggal-Tanggal Pemesanan:
            </div>

            <table class="table table-striped table-sm">
                <thead class="thead-dark">
                <tr>
                    <th> # </th>
                    <th> Tanggal </th>
                </tr>
                </thead>
                <tbody>
                @foreach($this->pemesananDates AS $pemesananDate)
                    <tr>
                        <td> {{ $loop->iteration }}  </td>
                        <td> {{ \App\Support\Formatter::date($pemesananDate->format("Y-m-d")) }} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </form>
</div>
