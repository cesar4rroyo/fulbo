<?php

namespace App\Http\Livewire;

use App\TempatPenyewaan;
use Livewire\Component;
use Livewire\WithPagination;
use App\Enums\MessageState;

class TempatPenyewaanIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $tempatPenyewaans = TempatPenyewaan::query()
            ->paginate();

        return view('livewire.tempat-penyewaan-index', compact(
            "tempatPenyewaans"
        ));
    }

    public function delete(int $id)
    {
        $tempatPenyewaan = TempatPenyewaan::query()->find($id);

        try {
            throw_if(!isset($tempatPenyewaan), new \Exception(
                "Data tidak tersedia."
            ));

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
