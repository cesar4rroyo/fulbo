<?php

namespace App\Http\Livewire;

use App\Enums\PemesananStatus;
use App\MemberTempatPenyewaan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

/**
 * @property MemberTempatPenyewaan memberTempatPenyewaan
 * @property Date latestPemesananDate
 */
class PemesananByMemberTempatPenyewaanCreate extends Component
{
    const N_PEMESANANS_TO_BE_CREATED = 4;
    public $memberTempatPenyewaanId;
    public $startDate;

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
            ->max('tanggal');

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
