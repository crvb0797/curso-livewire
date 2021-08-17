<div>
    <x-jet-danger-button wire:click="$set('open_modal', true)">
        Create new post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open_modal">
        <x-slot name="title">
            Crear nuevo post
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Título del post" />
                <x-jet-input name="title" type="text" placeholder="Nos encanta el agua..." class="w-full"
                    wire:model="title" />
                <x-jet-input-error for="title" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del post" />
                <textarea name="content" rows="6" class="form w-full" wire:model="content"
                    placeholder="Vivimos de ella..."></textarea>
                <x-jet-input-error for="content" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_modal', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save">
                Crear post
            </x-jet-danger-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>
