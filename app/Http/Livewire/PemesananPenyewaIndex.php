<?php

namespace App\Http\Livewire;

use App\Enums\PemesananStatus;
use App\Pemesanan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithPagination;

class PemesananPenyewaIndex extends Component
{
    use WithPagination;

    public $searchQuery;
    public $showAll;

    protected $listeners = [
        "cancel" => "cancel",
    ];

    protected $updatesQueryString = [
        "searchQuery",
        "showAll",
    ];

    public function mount()
    {
        $this->fill([
            "searchQuery" => request()->query("search", ""),
            "showAll" => request()->query("showAll", false),
        ]);
    }

    public function updating($attribute, $value)
    {
        dump(compact("attribute", "value"));
    }

    public function cancel($id)
    {
        Pemesanan::query()
            ->where("id", $id)
            ->update([
                "status" => PemesananStatus::BATAL,
            ]);
    }

    public function render()
    {
        $pemesanans = Pemesanan::query()
            ->with("tempat_penyewaan")
            ->when($this->showAll !== "true", function (Builder $builder) {
                $builder->whereDate('tanggal', '>', Date::now());
            })
            ->whereHas("penyewa", function (Builder $builder) {
                $builder->where("user_id", auth()->id());
            })
            ->orderByDesc("tanggal")
            ->paginate();

        return view('livewire.pemesanan-penyewa-index', [
            "pemesanans" => $pemesanans
        ]);
    }
}
