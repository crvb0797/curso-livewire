<div>
    <a class="btn btn-green" wire:click="$set('open',true)">
        <i class="fas fa-edit"></i>
    </a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar el post {{ $post->title }}
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Título del post" />
                <x-jet-input wire:model="post.title" type="text" class="w-full" value="" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Contenido del post" />
                <textarea wire:model="post.content" name="content" rows="6" class="form w-full"></textarea>
            </div>

            {{-- Mostrando la vista previa de la imagen utilizando la ruta temporal --}}
            <div wire:loading.flex wire:target="save" class="m-4 flex justify-center items-center py-4 lg:px-4">
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
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loading.attr="disable" class="disabled:opacity-25">
                Actualizar post
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
