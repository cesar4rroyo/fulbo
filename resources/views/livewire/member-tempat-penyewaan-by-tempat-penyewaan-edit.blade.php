<div>
    <h1 class="feature-title">
        <a href="{{ route("tempat-penyewaan.member-tempat-penyewaan-by-tempat-penyewaan.index", $this->memberTempatPenyewaan->tempat_penyewaan_id) }}">
            Member
        </a>
        /
        Ubah Pengajuan Member
    </h1>

    @include("shared.messages")

    <dl>
        <dt> Penyewa:</dt>
        <dd>
            <div> {{ $this->memberTempatPenyewaan->penyewa->user->name }} </div>
            <div> {{ $this->memberTempatPenyewaan->penyewa->no_telepon }} </div>
        </dd>
    </dl>

    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="hari_dalam_minggu"> Hari: </label>
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

        <div class="form-group">
            <label for="status">
                Status:
            </label>

            <select
                    wire:model="status"
                    name="status"
                    id="status"
                    class="form-control @error('status') is-invalid @enderror"
            >
                @foreach(\App\Enums\MemberTempatPenyewaanStatus::STATUSES AS $value)
                    <option value="{{ $value }}">
                        {{ $value }}
                    </option>
                @endforeach
            </select>

            @error('status')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-group">
            <div>
                Jadwal Sekarang:
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th> # </th>
                        <th> Waktu </th>
                        <th class="text-right"> Harga </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($this->currentSesiMembers AS $currentSesiMember)
                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            <td>
                                {{ $currentSesiMember->waktu_mulai }} -
                                {{ $currentSesiMember->waktu_selesai }}
                            </td>
                            <td class="text-right">
                                {{ \App\Support\Formatter::currency($this->price)  }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr>
                        <td></td>
                        <td class="text-right"> Total: </td>
                        <td class="text-right"> {{ \App\Support\Formatter::currency($this->currentTotalPrice) }} </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td class="text-right"> Total Bulanan (x {{ $this->multiplier }}): </td>
                        <td class="text-right font-weight-bold"> {{ \App\Support\Formatter::currency($this->currentGrandTotalPrice) }} </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>


        <div class="form-group">
            <label for="updates_sessions"> Perbarui Jadwal?: </label>
            <select
                    wire:model="updates_sessions"
                    id="updates_sessions"
                    type="checkbox"
                    class="form-control"
                    name="updates_sessions"
            >
                <option value="1"> Ya </option>
                <option value="0"> Tidak </option>
            </select>
        </div>

        @if($updates_sessions)
            <div class="form-group">
                <div> Jadwal Baru: </div>

                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th> # </th>
                            <th> Waktu </th>
                            <th class="text-right"> Harga </th>
                            <th class="text-center"> Pilih? </th>
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
                            <td class="text-right"> Total Bulanan (x {{ $this->multiplier }}: </td>
                            <td class="text-right font-weight-bold"> {{ \App\Support\Formatter::currency($this->grandTotalPrice) }} </td>
                        </tr>

                        </tfoot>
                    </table>
                </div>
            </div>
        @endif

        @error("sesi_members")
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                {{ $message }}
            </div>
        @enderror

        <div class="form-group text-right">
            <button class="btn btn-primary">
                Ubah
            </button>
        </div>
    </form>
</div>
