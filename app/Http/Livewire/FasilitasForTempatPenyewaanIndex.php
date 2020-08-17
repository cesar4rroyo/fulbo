<?php

namespace App\Http\Livewire;

use App\Enums\MessageState;
use App\Fasilitas;
use App\Support\SessionHelper;
use App\TempatPenyewaan;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * @property TempatPenyewaan $tempatPenyewaan
 */
class FasilitasForTempatPenyewaanIndex extends Component
{
    use WithPagination;

    public $tempatPenyewaanId;

    protected $listeners = [
        "fasilitas:delete" => "deleteFasilitas",
    ];

    public function mount($tempatPenyewaanId)
    {
        $this->tempatPenyewaanId = $tempatPenyewaanId;
    }

    public function getTempatPenyewaanProperty()
    {
        return TempatPenyewaan::query()
            ->findOrFail($this->tempatPenyewaanId);
    }

    public function getFasilitasListProperty()
    {
        return $this->tempatPenyewaan
            ->fasilitas()
            ->orderBy("nama")
            ->paginate();
    }

    public function deleteFasilitas($fasilitasId)
    {
        try {
            Fasilitas::query()
                ->where("id", $fasilitasId)
                ->delete();

            SessionHelper::flashMessage(
                __("messages.delete.success"),
                MessageState::STATE_SUCCESS,
            );
        } catch (\Throwable $throwable) {
            SessionHelper::flashMessage(
                __("messages.delete.failure"),
                MessageState::STATE_DANGER,
            );
        }
    }

    public function render()
    {
        return view('livewire.fasilitas-for-tempat-penyewaan-index');
    }
}
