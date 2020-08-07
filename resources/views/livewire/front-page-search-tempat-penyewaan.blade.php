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

    <div class="list-group position-absolute d-block"
        style="width: 100%; z-index: 1">
        @forelse($items as $item)
            <div
                x-data="{ hovered: false, url: '{{ route("tempat-penyewaan.page", $item)  }}' }"
                class="list-group-item list-group-item-action"
                :class="{ active: hovered }"
                x-on:mouseenter="hovered = true"
                x-on:mouseleave="hovered = false"
                x-on:click="window.location.replace(url)"
            >
                <div>
                    {{ $item->nama }}
                </div>

                <div>
                    {{ $item->alamat  }}
                </div>
            </div>
        @empty
            <div
                wire:loading
                class="list-group-item list-group-item-action">
                Melakukan pencarian...
            </div>

            @if($query !== "")
                <div
                    class="list-group-item list-group-item-action">
                    Tempat Tidak Ditemukan
                </div>
            @endif
        @endforelse
    </div>
</div>
