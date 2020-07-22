<?php

namespace App\Http\Livewire;

use App\TempatPenyewaan;
use Livewire\Component;
use Livewire\WithPagination;

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
}
