<button
    x-data="{ id: {{ $id }}, status: {{ $status }} }"
    x-on:click="
        confirmDialog()
                .then(response => {
                    if (!response.value) {
                        return
                    }
                    window.livewire.emit('toggle-verification', id)
                })
    "
    type="button"
    class="btn btn-sm {{ $status ? "btn-dark" : "btn-success" }} ">
    {{ $status ? "Batalkan Verifikasi" : "Verifikasi" }}
    <i class="fas {{ $status ? "fa-times" : "fa-check" }}"></i>
</button>
