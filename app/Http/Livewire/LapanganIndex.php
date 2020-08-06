<?php

namespace App\Http\Livewire;

use App\TempatPenyewaan;
use Livewire\Component;
use Livewire\WithPagination;

class LapanganIndex extends Component
{
    use WithPagination;

    public TempatPenyewaan $tempatPenyewaan;

    public function mount(TempatPenyewaan $tempatPenyewaan)
    {
        $this->tempatPenyewaan = $tempatPenyewaan;
    }

    public function render()
    {


        return view('livewire.lapangan-index');
    }
}
