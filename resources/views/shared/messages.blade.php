@foreach(session("messages") ?? [] as $message)
    <template
            wire:key="{{ rand() }}"
            x-data="{ visible: true }"
            x-init="window.setTimeout(() => { visible = false }, 2000)"
            x-if="visible"
    >
        <div
                class="my-3 alert alert-{{ $message['state'] ?? \App\Enums\MessageState::STATE_INFO }}">
            @switch($message['state'] ?? 'primary')
                @case(\App\Enums\MessageState::STATE_INFO)
                <i class="fas fa-info-circle"></i>
                @break
                @case(\App\Enums\MessageState::STATE_SUCCESS)
                <i class="fas fa-check-circle"></i>
                @break
                @case(\App\Enums\MessageState::STATE_WARNING)
                <i class="fas fa-exclamation-circle"></i>
                @break
                @case(\App\Enums\MessageState::STATE_DANGER)
                <i class="fas fa-times-circle"></i>
                @break
            @endswitch
            {{ $message['content'] ?? 'Default message content.' }}

            <button
                    x-on:click="visible = false"
                    type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </template>
@endforeach
