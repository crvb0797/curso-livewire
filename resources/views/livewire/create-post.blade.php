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
                    wire:model.defer="title" />
                <x-jet-input-error for="title" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del post" />
                <textarea name="content" rows="6" class="form w-full" wire:model.defer="content"
                    placeholder="Vivimos de ella..."></textarea>
                <x-jet-input-error for="content" />
            </div>


            @if ($image) {{-- tenemos algo guardado en la propiedad image ? --}}
                <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="Imagen de vista previa">
            @endif

            {{-- Mostrando la vista previa de la imagen utilizando la ruta temporal --}}
            <div wire:loading.flex wire:target="save, image" class="m-4 flex justify-center items-center py-4 lg:px-4">
                <div style="color: #63c5ab" class="la-ball-spin-clockwise">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>

            <div class="mb-4">
                <input type="file" name="image" wire:model="image" id="{{ $identificador }}">
                <x-jet-input-error for="image" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_modal', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25"
                wire:target="save, image">
                Crear post
            </x-jet-danger-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>
