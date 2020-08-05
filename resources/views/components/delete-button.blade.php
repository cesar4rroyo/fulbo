<button
        class="btn btn-sm btn-danger"
        x-data="{ id: {{ $itemId }} }"
        x-on:click="
            confirmDialog()
                .then(response => {
                    if (!response.value) {
                        return
                    }
                    window.livewire.emit('delete', id)
                })
        ">
    Hapus
    <i class="fas fa-trash"></i>
</button>
