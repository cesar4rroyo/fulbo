<?php

namespace App\Http\Livewire;

use App\TempatPenyewaan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class PemesananTempatPenyewaanIndex extends Component
{
    public $tempatPenyewaanId;
    public $searchQuery;
    public $showAll;

    protected $listeners = [
        "cancel" => "cancel",
    ];

    protected $updatesQueryString = [
        "searchQuery",
        "showAll",
    ];

    public function mount($tempatPenyewaanId)
    {
        $this->fill([
            "tempatPenyewaanId" => $tempatPenyewaanId,
            "searchQuery" => request()->query("search", ""),
            "showAll" => request()->query("showAll", false),
        ]);
    }

    public function getTempatPenyewaanProperty(): TempatPenyewaan
    {
        return TempatPenyewaan::query()
            ->findOrFail($this->tempatPenyewaanId);
    }

    public function getPemesanansProperty()
    {
        return $this->getTempatPenyewaanProperty()
            ->pemesanans()
            ->with([
                "member_tempat_penyewaan:id,penyewa_id",
                "penyewa.user"
            ])
            ->when($this->showAll !== "true", function (Builder $builder) {
                $builder->whereDate('tanggal', '>=', Date::now());
            })
            ->orderByDesc('tanggal')
            ->paginate();
    }

    public function render()
    {
        return view('livewire.pemesanan-tempat-penyewaan-index');
    }
}
