<?php

namespace App\Http\Livewire;

use App\Enums\MemberTempatPenyewaanStatus;
use App\Enums\MessageState;
use App\MemberTempatPenyewaan;
use App\SesiMember;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

/**
 * @property TempatPenyewaan tempatPenyewaan
 * @property Collection priceMap
 * @property array pickedSesiMembers
 * @property integer pickedCount
 * @property double price
 * @property double totalPrice
 * @property integer multiplier
 */
class MemberTempatPenyewaanByTempatPenyewaanCreate extends Component
{
    public $tempat_penyewaan_id;
    public $sesi_members;
    public $hari_dalam_minggu;

    public function mount($tempatPenyewaanId)
    {
        TempatPenyewaan::query()->findOrFail($tempatPenyewaanId);

        $this->tempat_penyewaan_id = $tempatPenyewaanId;
        $this->sesi_members = $this->getPossibleSessions();
        $this->hari_dalam_minggu = Carbon::MONDAY;
    }

    public function submit()
    {
        $this->validateFormData();
        $this->saveData();

        SessionHelper::flashMessage(
            "Pengajuan member Anda telah berhasil diajukan.",
            MessageState::STATE_SUCCESS,
        );

        $this->redirectRoute(
            "tempat-penyewaan.page",
            $this->tempat_penyewaan_id
        );
    }

    public function getMultiplierProperty()
    {
        return TempatPenyewaan::MEMBERSHIP_PRICE_MULTIPLIER;
    }

    public function getPriceMapProperty(): Collection
    {
        return $this->tempatPenyewaan->harga_pemesanans()
            ->pluck("harga", "hari_dalam_minggu");
    }

    public function getPriceProperty()
    {
        return $this->priceMap->get($this->hari_dalam_minggu);
    }

    public function getPickedSesiMembersProperty()
    {
        return array_filter($this->sesi_members, function ($row) {
            return $row["picked"];
        });
    }

    public function getPickedCountProperty()
    {
        return array_reduce($this->sesi_members, function ($current, $next) {
            return $current + ($next["picked"] ? 1 : 0);
        }, 0);
    }

    public function getTotalPriceProperty()
    {
        return $this->pickedCount * $this->price;
    }

    public function getGrandTotalPriceProperty()
    {
        return $this->totalPrice * $this->multiplier;
    }

    public function getTempatPenyewaanProperty()
    {
        return TempatPenyewaan::query()
            ->findOrFail($this->tempat_penyewaan_id);
    }

    public function getPossibleSessions()
    {
        return array_map(function ($row) {
            return array_merge($row, [
                "picked" => false,
            ]);
        }, $this->tempatPenyewaan->getPossibleSessionsArray());
    }

    public function render()
    {
        return view('livewire.member-tempat-penyewaan-by-tempat-penyewaan-create');
    }

    private function validateFormData(): void
    {
        $this->validate([
            "tempat_penyewaan_id" => ["required", Rule::exists(TempatPenyewaan::class, "id")],
            "sesi_members" => [
                "required",
                "array",
                function ($attribute, $rows, $fail) {
                    $pickedCount = array_reduce($rows, function ($current, $next) {
                        return $current + ($next["picked"] ? 1 : 0);
                    }, 0);

                    switch (true) {
                        case $pickedCount < 1:
                            $fail("Anda minimal memilih satu (1) pemesanan.");
                            break;
                        case $pickedCount > 3:
                            $fail("Anda maksimal memilih tiga (3) pemesanan.");
                            break;
                    }
                }],
            "sesi_members.*.picked" => ["required", "boolean"],
            "sesi_members.*.start" => ["required", "dateformat:H:i:s"],
            "sesi_members.*.finish" => ["required", "dateformat:H:i:s"],
        ]);
    }

    private function saveData(): void
    {
        DB::beginTransaction();

        /** @var MemberTempatPenyewaan $membership */
        $membership = MemberTempatPenyewaan::query()
            ->create([
                "status" => MemberTempatPenyewaanStatus::INACTIVE,
                "penyewa_id" => auth()->user()->penyewa->id,
                "tempat_penyewaan_id" => $this->tempat_penyewaan_id,
                "hari_dalam_minggu" => $this->hari_dalam_minggu,
            ]);

        foreach ($this->pickedSesiMembers as $pickedSesiMember) {
            SesiMember::query()->create([
               "member_tempat_penyewaan_id" => $membership->id,
                "waktu_mulai" => $pickedSesiMember["start"],
                "waktu_selesai" => $pickedSesiMember["finish"],
            ]);
        }

        DB::commit();
    }
}
