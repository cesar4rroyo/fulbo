<?php

namespace App\Http\Livewire;

use App\TempatPenyewaan;
use Livewire\Component;

class FrontPageSearchTempatPenyewaan extends Component
{
    public $items = [];
    public $query = "";

    public $listeners = [
        'clearQuery' => 'clearQuery',
    ];

    public function render()
    {
        return view('livewire.front-page-search-tempat-penyewaan');
    }

    public function clearQuery()
    {
        $this->query = "";
        $this->items = [];
    }

    public function updatingQuery($query)
    {
        if (strlen($query) == 0) {
            $this->items = [];
            return;
        }
        else {
            $this->items = TempatPenyewaan::query()
                ->where("nama", "like", "%{$query}%")
                ->orderBy("nama")
                ->limit(10)
                ->get();
        }
    }
}
