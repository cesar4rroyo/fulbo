<?php

namespace App\Http\Livewire;

use App\Support\SessionHelper;
use App\TempatPenyewaan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use App\Enums\MessageState;

class TempatPenyewaanIndex extends Component
{
    const EVENT_TOGGLE_VERIFICATION = self::class . ".toggle-verification";

    use WithPagination;

    protected $listeners = [
        IndexSearch::EVENT_SEARCH_QUERY_UPDATE => "onSearch",
        "toggle-verification" => "onToggleVerification",
        "delete" => "delete",
    ];

    protected $updatesQueryString = [
        "selectedOption",
    ];

    const OPTION_TERVERIFIKASI = "Terverifikasi";
    const OPTION_TIDAK_TERVERIFIKASI = "Tidak Terverifikasi";
    const OPTION_ALL = "Semua";

    public $options = [
        self::OPTION_TERVERIFIKASI,
        self::OPTION_TIDAK_TERVERIFIKASI,
        self::OPTION_ALL,
    ];

    public $selectedOption = self::OPTION_ALL;
    public $searchQuery;

    public function mount(Request $request)
    {
        $this->fill([
            "selectedOption" => $request->query("selectedOption", self::OPTION_ALL)
        ]);
    }

    public function updating($name, $value)
    {
        switch ($name) {
            case "selectedOption":
            case "searchQuery":
                $this->resetPage();
        }
    }

    public function onSearch($searchQuery)
    {
        $this->searchQuery = $searchQuery;
    }

    public function onToggleVerification($id)
    {
        try {
            $item = TempatPenyewaan::query()->findOrFail($id);
            $item->update([
                "terverifikasi" => $item->terverifikasi ? 0 : 1,
            ]);

            SessionHelper::flashMessage(__("messages.update.success"), MessageState::STATE_SUCCESS);
        } catch (\Exception $ex) {
            SessionHelper::flashMessage(__("messages.update.failure"), MessageState::STATE_DANGER);
        }
    }

    public function render()
    {
        $tempatPenyewaans = TempatPenyewaan::query()
            ->with("admin")
            ->where("nama", "like", "%$this->searchQuery%")
            ->when($this->selectedOption, function (Builder $builder, $option) {
                switch ($option) {
                    case self::OPTION_TERVERIFIKASI:
                        $builder->where('terverifikasi', 1); break;
                    case self::OPTION_TIDAK_TERVERIFIKASI:
                        $builder->where('terverifikasi', 0); break;
                }
            })
            ->orderBy('nama')
            ->paginate();

        return view('livewire.tempat-penyewaan-index', compact(
            "tempatPenyewaans"
        ));
    }

    public function delete(int $id)
    {
        try {
            $tempatPenyewaan = TempatPenyewaan::query()
                ->findOrFail($id);

            $tempatPenyewaan->delete();
        } catch (\Exception $ex) {
            SessionHelper::flashMessage(__("messages.delete.failure"), MessageState::STATE_DANGER);
        }

        session()->flash("messages", [
            [
                "content" => __("messages.delete.success"),
                "state" => MessageState::STATE_SUCCESS
            ]
        ]);
    }
}
