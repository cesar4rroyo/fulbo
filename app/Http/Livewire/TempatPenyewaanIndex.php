<?php

namespace App\Http\Livewire;

use App\TempatPenyewaan;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use App\Enums\MessageState;

class TempatPenyewaanIndex extends Component
{
    use WithPagination;

    protected $listeners = [
        "delete" => "delete",
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

    public function render()
    {
        $tempatPenyewaans = TempatPenyewaan::query()
            ->with("admin")
            ->when($this->selectedOption, function (Builder $builder, $option) {
                switch ($option) {
                    case self::OPTION_TERVERIFIKASI:
                        $builder->where('terverifikasi', 1); break;
                    case self::OPTION_TIDAK_TERVERIFIKASI:
                        $builder->where('terverifikasi', 0); break;
                }
            })
            ->paginate();

        return view('livewire.tempat-penyewaan-index', compact(
            "tempatPenyewaans"
        ));
    }

    public function delete(int $id)
    {
        try {
            $tempatPenyewaan = TempatPenyewaan::query()
                ->where('terverifikasi', 1)
                ->firstOrFail($id);

            $tempatPenyewaan->delete();
        } catch (\Exception $ex) {
            session()->flash("messages", [
                [
                    "content" => __("messages.delete.failure"),
                    "state" => MessageState::STATE_DANGER
                ],
                [
                    "content" => __("messages.delete.failure"),
                    "state" => MessageState::STATE_DANGER
                ]
            ]);
        }

        session()->flash("messages", [
            [
                "content" => __("messages.delete.success"),
                "state" => MessageState::STATE_SUCCESS
            ]
        ]);
    }
}
