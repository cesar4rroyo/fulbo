<?php

namespace App\Http\Livewire;


use App\Enums\MessageState;
use App\Pemesanan;
use App\Providers\AuthServiceProvider;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use Carbon\CarbonPeriod;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class PemesananPenyewaCreate extends Component
{
    use AuthorizesRequests;

    public $tempat_penyewaan_id;
    public $pemesanan_data;
    public $item_pemesanans_data;

    public function submit()
    {
        $this->authorize(AuthServiceProvider::ACTION_CREATE_PEMESANAN_PENYEWA);

        $this->validate([
            "pemesanan_data.tanggal_pemesanan" => ["required", "dateformat:Y-m-d"],
            "pemesanan_data.tempat_penyewaan_id" => ["required", Rule::exists(TempatPenyewaan::class, "id")],
            "item_pemesanans_data" => [
                "required",
                "array",
                function ($attribute, $rows, $fail) {
                    $pickedCount = array_reduce($rows, function ($current, $next) {
                        return $current + ($next["picked"] ? 1 : 0);
                    }, 0);

                    if ($pickedCount === 0) {
                        $fail("Anda wajib melakukan minimal satu (1) pemesanan.");
                    }
                },
            ],
            "item_pemesanans_data.*.picked" => ["required", "boolean"],
            "item_pemesanans_data.*.start" => ["required", "dateformat:H:i:s"],
            "item_pemesanans_data.*.finish" => ["required", "dateformat:H:i:s"],
        ]);

        DB::beginTransaction();

        /** @var Pemesanan $pemesanan */
        $pemesanan = Pemesanan::query()->create([
            "penyewa_id" => auth()->user()->penyewa->id,
            "tanggal" => $this->pemesanan_data["tanggal_pemesanan"],
            "tempat_penyewaan_id" => $this->pemesanan_data["tempat_penyewaan_id"],
        ]);

        foreach ($this->item_pemesanans_data as $item_pemesanan_data) {
            if (!$item_pemesanan_data["picked"]) {
                continue;
            }

            $pemesanan->items()->create([
                "waktu_mulai" =>  $item_pemesanan_data["start"],
                "waktu_selesai" =>  $item_pemesanan_data["finish"],
                "harga" => $this->getPriceProperty(),
            ]);
        }

        DB::commit();

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS
        );

        $this->redirectRoute("pemesanan-penyewa.index");
    }

    public function mount($idTempatPenyewaan)
    {
        $this->tempat_penyewaan_id = $idTempatPenyewaan;

        $this->pemesanan_data = [
            "tempat_penyewaan_id" => $this->tempat_penyewaan_id,
            "tanggal_pemesanan" => app("date")->today()
                ->format("Y-m-d")
        ];

        /** @var TempatPenyewaan $tempatPenyewaan */
        $tempatPenyewaan = TempatPenyewaan::query()
            ->findOrFail($this->tempat_penyewaan_id);

        $this->item_pemesanans_data = $tempatPenyewaan
            ->getPossibleSessions()
            ->map(function (CarbonPeriod $carbonPeriod) {
                return [
                    "start" => $carbonPeriod->getStartDate()->format("H:i:s"),
                    "finish" => $carbonPeriod->getEndDate()->format("H:i:s"),
                    "picked" => false,
                ];
            })->toArray();
    }

    public function getPickedItemPemesanansProperty()
    {
        return array_filter($this->item_pemesanans_data, function ($data) {
            return $data["picked"];
        });
    }

    public function getPriceProperty()
    {
        /** @var TempatPenyewaan $tempatPenyewaan */
        $tempatPenyewaan = TempatPenyewaan::query()
            ->findOrFail($this->tempat_penyewaan_id);

        $hargaPemesanans = $tempatPenyewaan->harga_pemesanans()
            ->pluck("harga", "hari_dalam_minggu");

        $weekDay = Date::create($this->pemesanan_data["tanggal_pemesanan"])
            ->weekday();

        return $hargaPemesanans[$weekDay] ?? null;
    }

    public function getTotalPriceProperty()
    {
        return array_reduce($this->item_pemesanans_data, function ($current, $next) {
            return $current + ($next["picked"] ? $this->price : 0);
        }, 0);
    }

    public function render()
    {
        return view('livewire.pemesanan-penyewa-create');
    }
}
