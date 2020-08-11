<?php

namespace App\Http\Livewire;

use App\Enums\MemberTempatPenyewaanStatus;
use App\Enums\MessageState;
use App\Http\Livewire\Casts\BooleanCaster;
use App\MemberTempatPenyewaan;
use App\SesiMember;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

/**
 * @property TempatPenyewaan tempatPenyewaan
 * @property MemberTempatPenyewaan memberTempatPenyewaan
 * @property Collection priceMap
 * @property array pickedSesiMembers
 * @property integer pickedCount
 * @property double price
 */
class MemberTempatPenyewaanByTempatPenyewaanEdit extends Component
{
    public $member_tempat_penyewaan_id;
    public $tempat_penyewaan_id;
    public $sesi_members;
    public $hari_dalam_minggu;
    public $status;
    public $updates_sessions;

    public function mount($memberTempatPenyewaanId, $tempatPenyewaanId)
    {
        MemberTempatPenyewaan::query()->findOrFail($memberTempatPenyewaanId);
        TempatPenyewaan::query()->findOrFail($tempatPenyewaanId);

        $this->tempat_penyewaan_id = $tempatPenyewaanId;
        $this->member_tempat_penyewaan_id = $memberTempatPenyewaanId;
        $this->sesi_members = $this->getPossibleSessions();
        $this->hari_dalam_minggu = $this->memberTempatPenyewaan->hari_dalam_minggu;
        $this->status = $this->memberTempatPenyewaan->status;
        $this->updates_sessions = "0";
    }

    public function getMemberTempatPenyewaanProperty()
    {
        return MemberTempatPenyewaan::query()
            ->findOrFail($this->member_tempat_penyewaan_id);
    }

    public function getCurrentSesiMembersProperty()
    {
        return $this->memberTempatPenyewaan->sesi_members()
            ->orderBy("waktu_mulai")
            ->get();
    }

    public function submit()
    {
        $this->validateFormData();
        $this->saveData();

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        $this->sesi_members = $this->getPossibleSessions();
        $this->updates_sessions = "0";
    }

    public function getMultiplierProperty()
    {
        return TempatPenyewaan::MEMBERSHIP_PRICE_MULTIPLIER;
    }

    public function getCurrentTotalPriceProperty()
    {
        return $this->currentSesiMembers->count() * $this->price;
    }

    public function getCurrentGrandTotalPriceProperty()
    {
        return $this->currentTotalPrice * $this->multiplier;
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
        return view('livewire.member-tempat-penyewaan-by-tempat-penyewaan-edit');
    }

    private function validateFormData(): void
    {
        $this->validate($this->membershipValidationRules());

        if ($this->updates_sessions) {
            $this->validate($this->membershipSessionsValidationRules());
        }
    }

    private function saveData(): void
    {
        DB::beginTransaction();

        $this->memberTempatPenyewaan->update([
            "hari_dalam_minggu" => $this->hari_dalam_minggu,
        ]);

        if ($this->updates_sessions) {
            SesiMember::query()
                ->where("member_tempat_penyewaan_id", $this->memberTempatPenyewaan->id)
                ->delete();

            foreach ($this->pickedSesiMembers as $pickedSesiMember) {
                SesiMember::query()->create([
                    "member_tempat_penyewaan_id" => $this->memberTempatPenyewaan->id,
                    "waktu_mulai" => $pickedSesiMember["start"],
                    "waktu_selesai" => $pickedSesiMember["finish"],
                ]);
            }
        }

        DB::commit();
    }

    /**
     * @return array[]
     */
    private function membershipValidationRules(): array
    {
        return [
            "hari_dalam_minggu" => ["required", Rule::in(array_keys(Date::getDays()))],
        ];
    }

    /**
     * @return array
     */
    private function membershipSessionsValidationRules(): array
    {
        return [
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
        ];
    }
}
