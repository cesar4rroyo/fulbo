<?php

namespace App\Http\Livewire;


use App\Enums\MessageState;
use App\Pemesanan;
use App\Providers\AuthServiceProvider;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Rule;
use Livewire\Component;

/**
 * @property double hourlyPrice
 */
class PemesananPenyewaCreate extends Component
{
    use AuthorizesRequests;

    public $tempat_penyewaan_id;
    public $pemesanan_data;
    public $item_pemesanans_data;

    public function removeItemPemesananData($index)
    {
        $this->item_pemesanans_data = array_filter($this->item_pemesanans_data, function ($key) use ($index) {
            return $key !== $index;
        }, ARRAY_FILTER_USE_KEY);
    }

    public function tambahItemPemesanan()
    {
        $this->item_pemesanans_data[] = [
            "start" => null,
            "finish" => null,
            "price" => null,
        ];
    }

    public function submit()
    {
        $this->authorize(AuthServiceProvider::ACTION_CREATE_PEMESANAN_PENYEWA);

        $tempatPenyewaan = TempatPenyewaan::query()
            ->find($this->tempat_penyewaan_id);

        $data = ValidatorFacade::make($this->getPublicPropertiesDefinedBySubClass(), [
            "pemesanan_data.tanggal_pemesanan" => ["required", "dateformat:Y-m-d"],
            "pemesanan_data.tempat_penyewaan_id" => ["required", Rule::exists(TempatPenyewaan::class, "id")],
            "item_pemesanans_data" => ["required", "array"],
            "item_pemesanans_data.*.start" => ["required", "dateformat:H:i", "after:{$tempatPenyewaan->waktu_buka}", "before:item_pemesanans_data.*.finish"],
            "item_pemesanans_data.*.finish" => ["required", "dateformat:H:i", "before:{$tempatPenyewaan->waktu_tutup}"],
        ])->after(function (Validator $validator) {
            /** @var CarbonPeriod[]|Collection $periods */
            $periods = collect($validator->validated()["item_pemesanans_data"])
                ->map(function ($item) {
                    return CarbonPeriod::between(
                        $item["start"],
                        $item["finish"],
                    );
                });

            for ($i = 0; $i < $periods->count(); ++$i) {
                for ($j = $i + 1; $j < $periods->count(); ++$j) {
                    if ($periods[$i]->overlaps($periods[$j])) {
                        $validator->errors()->add(
                            "item_pemesanans_data",
                            sprintf(
                                "Rentang waktu tidak boleh saling bertabrakan: (%s-%s) dengan (%s-%s)",
                                $periods[$i]->getStartDate()->format("H:i"),
                                $periods[$i]->getEndDate()->format("H:i"),
                                $periods[$j]->getStartDate()->format("H:i"),
                                $periods[$j]->getEndDate()->format("H:i"),
                            )
                        );
                    }
                }
            }
        })->validate();

        DB::beginTransaction();

        /** @var Pemesanan $pemesanan */
        $pemesanan = Pemesanan::query()->create([
            "penyewa_id" => auth()->user()->penyewa->id,
            "tanggal" => $this->pemesanan_data["tanggal_pemesanan"],
            "tempat_penyewaan_id" => $this->pemesanan_data["tempat_penyewaan_id"],
        ]);

        foreach ($data["item_pemesanans_data"] as $item_pemesanan_data) {
            $pemesanan->items()->create([
                "waktu_mulai" =>  $item_pemesanan_data["start"],
                "waktu_selesai" =>  $item_pemesanan_data["finish"],
                "harga" => $this->calculateItemHourLength(
                    $item_pemesanan_data["start"],
                    $item_pemesanan_data["finish"],
                ) * $this->hourlyPrice,
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

        $this->item_pemesanans_data = [];
    }

    public function getPickedItemPemesanansProperty()
    {
        return array_filter($this->item_pemesanans_data, function ($data) {
            return $data["picked"];
        });
    }

    public function getHourlyPriceProperty()
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
            return $current + ($next["price"] ?? 0);
        }, 0);
    }

    private function calculateItemHourLength($start, $finish)
    {
        $start = Carbon::createFromFormat("H:i", $start);
        $finish = Carbon::createFromFormat("H:i", $finish);
        $diff = $finish->diff($start);
        return $diff->h + ($diff->i / 60);
    }

    public function render()
    {
        $this->item_pemesanans_data = array_map(function ($item) {
            if ($item["start"] === null || $item["finish"] === null) {
                $item["hour_diff"] = 0;
            }
            else {
                $item["hour_diff"] = $this->calculateItemHourLength(
                    $item["start"],
                    $item["finish"]
                );
            }

            $item["price"] = $this->hourlyPrice * $item["hour_diff"];
            return $item;
        }, $this->item_pemesanans_data);

        return view('livewire.pemesanan-penyewa-create', [
            "tempat_penyewaan" => TempatPenyewaan::query()
                ->find($this->tempat_penyewaan_id)
        ]);
    }
}
