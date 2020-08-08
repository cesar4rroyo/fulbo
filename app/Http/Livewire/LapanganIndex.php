<?php

namespace App\Http\Livewire;

use App\Enums\MessageState;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use Livewire\Component;
use Livewire\WithPagination;

class LapanganIndex extends Component
{
    use WithPagination;

    protected $listeners = [
        "delete" => "onDelete",
    ];

    /** @var TempatPenyewaan */
    public $tempatPenyewaan;

    public function mount($tempatPenyewaanId)
    {
        $this->tempatPenyewaan = TempatPenyewaan::query()
            ->findOrFail($tempatPenyewaanId);
    }

    public function onDelete(int $id)
    {
        try {
            $lapangan = $this->tempatPenyewaan
                ->lapangans()
                ->findOrFail($id);

            $lapangan->delete();

            SessionHelper::flashMessage(
                __("messages.delete.success"),
                MessageState::STATE_SUCCESS
            );
        } catch (\Exception $ex) {
            SessionHelper::flashMessage(
                __("messages.delete.failure"),
                MessageState::STATE_DANGER
            );
        }
    }

    public function render()
    {
        $lapangans = $this->tempatPenyewaan->lapangans()
            ->orderBy("nama")
            ->paginate();

        return view('livewire.lapangan-index', [
            "tempatPenyewaan" => $this->tempatPenyewaan,
            "lapangans" => $lapangans,
        ]);
    }
}
