<div style="width: 100%">
    <label for="search">
    <input
        class="form-control" style="width: 100%"
        id="search"
        wire:model.debounce.500ms="query"
        placeholder="Search..."
        type="text">
    </label>
</div>
