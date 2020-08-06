<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class IndexSearch extends Component
{
    const EVENT_SEARCH_QUERY_UPDATE = self::class . ".search-query-update";

    protected $updatesQueryString = [
        "query" => ["except" => ""],
    ];

    public $query;

    public function mount(Request $request)
    {
        $this->query = $request->query("query", "");
    }

    public function updatingQuery($newQuery)
    {
        $this->emitUp(self::EVENT_SEARCH_QUERY_UPDATE, $newQuery);
    }

    public function render()
    {
        return view('livewire.index-search');
    }
}
