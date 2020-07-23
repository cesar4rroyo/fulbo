<div class="position-relative">
    <label for="search"
           class="d-block mt-2">
        <input
            autocomplete="off"
            wire:model="query"
            x-data="{}"
            x-on:focusout="window.livewire.emit('clearQuery')"
            class="form-control form-control-lg"
            id="search"
            placeholder="Cari Tempat Penyewaan"
            type="text">
    </label>

    <ul class="list-group position-absolute d-block"
        style="width: 100%; z-index: 1">
        @forelse($items as $item)
            <li
                x-data="{ hovered: false }"
                class="list-group-item list-group-item-action"
                :class="{ active: hovered }"
                x-on:mouseenter="hovered = true"
                x-on:mouseleave="hovered = false"
            >
                {{ $item->nama }}
            </li>
        @empty
            <li
                wire:loading
                class="list-group-item list-group-item-action">
                Melakukan pencarian...
            </li>

            @if($query !== "")
                <li
                    class="list-group-item list-group-item-action">
                    Tempat Tidak Ditemukan
                </li>
            @endif
        @endforelse
    </ul>
</div>
