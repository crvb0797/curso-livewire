<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container sm:px-6 lg:px-8 py-12">
        <x-table>

            <div class="px-6 py-4 flex items-center">
                {{-- <input type="text" wire:model="search"> --}}
                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select wire:model="cant" name="paginate_input" class="mx-2 form">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="">Entradas</span>
                </div>
                <x-jet-input class="flex-1 mx-4" placeholder="Search for title or content...🔎" type="text"
                    wire:model="search" />
                @livewire('create-post')
            </div>

            @if ($posts->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24"
                                wire:click="order('id')">
                                #

                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-amount-up float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-amount-down float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-filter float-right mt-1"></i>
                                @endif

                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('title')">
                                Title

                                @if ($sort == 'title')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-amount-up float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-amount-down float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-filter float-right mt-1"></i>
                                @endif


                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('content')">
                                Content

                                @if ($sort == 'content')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-amount-up float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-amount-down float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-filter float-right mt-1"></i>
                                @endif

                            </th>

                            <th scope="col" class="relative px-6 py-3">

                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($posts as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $item->id }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $item->title }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $item->content }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                                    <a class="btn btn-green" wire:click="edit({{ $item }})">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4">
                    <p>Ningun resultado para la busqueda...🤔</p>
                </div>
            @endif

            @if ($posts->hasPages())
                <div class="px-6 py-3">
                    {{ $posts->links() }}
                </div>
            @endif

        </x-table>
    </div>

    <x-jet-dialog-modal wire:model="open_edit">
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
            @if ($image) {{-- tenemos algo guardado en la propiedad image ? --}}
                <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="Imagen de vista previa">
            @else
                <img src="{{ Storage::url($post->image) }}" alt="">
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
            <x-jet-secondary-button wire:click="$set('open_edit', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="update" wire:loading.attr="disable" class="disabled:opacity-25">
                Actualizar post
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
