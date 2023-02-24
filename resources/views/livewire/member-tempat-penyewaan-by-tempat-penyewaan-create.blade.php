<div>
    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="hari_dalam_minggu"> Día: </label>
            <select
                    wire:model="hari_dalam_minggu"
                    id="hari_dalam_minggu"
                    type="text"
                    class="form-control @error("hari_dalam_minggu") is-invalid @enderror"
                    name="hari_dalam_minggu"
            >
                @foreach(\Facades\App\Support\DateUtil::getLocalDays() AS $dayIndex => $dayName)
                    <option value="{{ $dayIndex }}">
                        {{ $dayName  }}
                    </option>
                @endforeach
            </select>
            @error("hari_dalam_minggu")
            <span class="invalid-feedback">
                {{ $message }}
            </span>
            @enderror
        </div>

        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead class="thead-dark">
                <tr>
                    <th> # </th>
                    <th> Tiempo </th>
                    <th class="text-right"> Precio </th>
                    <th class="text-center"> Seleccionar? </th>
                </tr>
                </thead>

                <tbody>
                @foreach($sesi_members AS $sesi)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td>
                            {{ $sesi["start"] }} -
                            {{ $sesi["finish"] }}
                        </td>
                        <td class="text-right">
                            {{ \App\Support\Formatter::currency($this->price)  }}
                        </td>
                        <td class="text-center">
                            <label for="sesi_members.{{ $loop->index }}.picked">
                                <input
                                        id="sesi_members.{{ $loop->index }}.picked"
                                        wire:model="sesi_members.{{ $loop->index }}.picked"
                                        type="checkbox">
                            </label>

                            @error("sesi_members.{$loop->index}.picked")
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </td>
                    </tr>
                @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td></td>
                        <td class="text-right"> Total: </td>
                        <td class="text-right"> {{ \App\Support\Formatter::currency($this->totalPrice) }} </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td class="text-right"> Total Mensual (x {{ $this->multiplier }}): </td>
                        <td class="text-right"> {{ \App\Support\Formatter::currency($this->grandTotalPrice) }} </td>
                    </tr>
                </tfoot>

            </table>
        </div>

        @error("sesi_members")
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                {{ $message }}
            </div>
        @enderror

        <div class="form-group text-right">
            <button class="btn btn-primary">
                Aplicar
            </button>
        </div>
    </form>
</div>
