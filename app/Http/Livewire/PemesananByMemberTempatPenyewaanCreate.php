<?php

namespace App\Http\Livewire;

use App\Enums\MessageState;
use App\Enums\PemesananStatus;
use App\MemberTempatPenyewaan;
use App\Pemesanan;
use App\Support\SessionHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

/**
 * @property MemberTempatPenyewaan memberTempatPenyewaan
 * @property Date latestPemesananDate
 * @property Date[] pemesananDates
 */
class PemesananByMemberTempatPenyewaanCreate extends Component
{
    const N_PEMESANANS_TO_BE_CREATED = 4;
    public $memberTempatPenyewaanId;
    public $startDate;

    public function submit()
    {
        DB::beginTransaction();

        $price = $this->memberTempatPenyewaan
            ->tempat_penyewaan
            ->harga_pemesanans()
            ->where("hari_dalam_minggu", $this->memberTempatPenyewaan->hari_dalam_minggu)
            ->value("harga");

        $sesiMembers = $this->memberTempatPenyewaan
            ->sesi_members()
            ->get();

        foreach ($this->pemesananDates as $date) {
            /** @var Pemesanan $pemesanan */
            $pemesanan = Pemesanan::query()
                ->create([
                    "tanggal" => $date,
                    "status" => PemesananStatus::DITERIMA,
                    "penyewa_id" => $this->memberTempatPenyewaan->penyewa_id,
                    "tempat_penyewaan_id" => $this->memberTempatPenyewaan->tempat_penyewaan_id,
                    "member_tempat_penyewaan_id" => $this->memberTempatPenyewaanId,
                ]);

            foreach ($sesiMembers as $sesiMember) {
                $pemesanan->items()->create([
                    "waktu_mulai" => $sesiMember->waktu_mulai,
                    "waktu_selesai" => $sesiMember->waktu_selesai,
                    "harga" => $price,
                ]);
            }
        }

        DB::commit();

        SessionHelper::flashMessage(
            __("messages.create.success"),
            MessageState::STATE_SUCCESS,
        );

        $this->redirectRoute(
            "tempat-penyewaan.member-tempat-penyewaan-by-tempat-penyewaan.index",
            $this->memberTempatPenyewaan->tempat_penyewaan_id
        );
    }

    public function mount($memberTempatPenyewaanId)
    {
        $this->memberTempatPenyewaanId = $memberTempatPenyewaanId;
        $this->startDate = $this->getLatestPemesananDateProperty()->format("Y-m-d");
    }

    public function getMemberTempatPenyewaanProperty()
    {
        return MemberTempatPenyewaan::query()
            ->findOrFail($this->memberTempatPenyewaanId);
    }

    public function getLatestPemesananDateProperty()
    {
        /** @var Carbon $maxDate */
        $maxDate = $this->memberTempatPenyewaan
            ->pemesanans()
            ->where('status', PemesananStatus::DITERIMA)
            ->selectRaw("MAX(tanggal) as maxDate")
            ->withCasts(["maxDate" => "date"])
            ->value("maxDate");

        return !empty($maxDate) ?
            $maxDate->next($this->memberTempatPenyewaan->hari_dalam_minggu) :
            Date::today()->next($this->memberTempatPenyewaan->hari_dalam_minggu)  ;
    }

    public function rewindDate()
    {
        $targetDate = Date::create($this->startDate)
            ->previous($this->memberTempatPenyewaan->hari_dalam_minggu);

        $this->startDate = (
            $targetDate->lessThan($this->latestPemesananDate) ?
                $this->latestPemesananDate :
                $targetDate
        )->format("Y-m-d");
    }

    public function forwardDate()
    {
        $this->startDate = Date::create($this->startDate)
            ->next($this->memberTempatPenyewaan->hari_dalam_minggu)
            ->format("Y-m-d");
    }

    public function getPemesananDatesProperty()
    {
        $dates = [];

        $temp = Date::create($this->startDate);

        for ($i = 0; $i < self::N_PEMESANANS_TO_BE_CREATED; ++$i) {
            $dates[] = $temp;
            $temp = $temp->clone()->next($this->memberTempatPenyewaan->hari_dalam_minggu);
        }

        return $dates;
    }

    public function render()
    {
        return view('livewire.pemesanan-by-member-tempat-penyewaan-create');
    }
}
