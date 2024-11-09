<div>
    <x-dialog-modal wire:model="isOpen" maxWidth="lg">
        <x-slot name="title">
            @if ($ruteCreate)
            <h3 class="text-center">Registrar nueva Empresa</h3>
            @else
            <h3 class="text-center">Actualizar Empresa</h3>
            @endif
        </x-slot>
        <x-slot name="content">
            <form autocomplete="off">

                <input type="hidden" wire:model="empresa.id">
                <div class="flex flex-col sm:flex-row gap-2.5 w-full px-2">

                    <div class="flex flex-col gap-2.5 w-full">

                        <div class="flex  justify-center">
                            <div class="w-full px-6">
                                <x-label value="Nombre de la Empresa" class="font-bold" />
                                <x-input class="w-full" type="text" wire:model="empresa.ra_social" />
                                @unless (!empty($empresa['ra_social']))
                                <x-input-error for="empresa.ra_social" />
                                @endunless
                            </div>
                        </div>

                        <div class="flex flex-row justify-center gap-2.5 w-full">
                            <div>
                                <x-label value="Correo de la Empresa" class="font-bold" />
                                <x-input type="text" wire:model="empresa.correo" />
                                @unless (!empty($empresa['correo']))
                                <x-input-error for="empresa.correo" />
                                @endunless
                            </div>
                            <div>
                                <x-label value="RUC de la Empresa" class="font-bold" />
                                <x-input type="text" wire:model="empresa.ruc" />
                                @unless (!empty($empresa['ruc']))
                                <x-input-error for="empresa.ruc" />
                                @endunless
                            </div>
                        </div>
                        <div class="flex flex-row justify-center gap-2.5 w-full">
                            <div>
                                <x-label value="Direccion de la Empresa" class="font-bold" />
                                <x-input type="text" wire:model="empresa.direccion" />
                                @unless (!empty($empresa['direccion']))
                                <x-input-error for="empresa.direccion" />
                                @endunless
                            </div>
                            <div>
                                <x-label value="Telefono de la Empresa" class="font-bold" />
                                <x-input type="text" wire:model="empresa.telefono" />
                                @unless (!empty($empresa['telefono']))
                                <x-input-error for="empresa.telefono" />
                                @endunless
                            </div>
                        </div>
                        <div>
                            <x-label value="whatsap de la Empresa" class="font-bold" />
                            <x-input type="text" wire:model="empresa.whatsap" />
                            @unless (!empty($empresa['whatsap']))
                            <x-input-error for="empresa.whatsap" />
                            @endunless
                        </div>
                        <div class="flex-auto px-7">
                            <x-label value="Asignar usuario" class="font-bold" />
                            <x-select wire:model="empresa.user_id">
                                <x-slot name="options">
                                    <option value="" selected>Seleccione...</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user['user_id'] ?? '' == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                    @endforeach
                                </x-slot>
                            </x-select>
                            @error('empresa.user_id')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex-auto">
                            <x-label value="Categoria Laboral" class="font-bold" />
                            <x-select wire:model="empresa.category_id">
                                <x-slot name="options">
                                    <option value="" selected>Seleccione...</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $empresa['category_id'] ?? '' == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </x-slot>
                            </x-select>
                            @error('empresa.category_id')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex  justify-center">
                            <div class="w-full px-6">
                                <x-label value="Imagen" class="font-bold" />
                                <div>
                                    <div class="border border-gray-300 rounded-lg">
                                        <label
                                            class="text-white text-sm rounded-t-lg bg-gray-600 focus:bg-gray-600 active:bg-gray-700 inline-flex items-center justify-center w-full px-4 py-2 cursor-pointer">
                                            <i class="fa-solid fa-upload mr-1"></i>Cargar Imagen
                                            <input wire:model="image" type="file" hidden />
                                        </label>

                                        <div wire:loading wire:target="image" class="w-full">
                                            <div id="alert-4"
                                                class="flex items-center justify-center p-3 mb-4 text-yellow-800 rounded-lg bg-yellow-50"
                                                role="alert">
                                                <i class="fa-solid fa-circle-exclamation"></i>
                                                <div class="ml-2 text-xs font-medium">
                                                    Espere un momento por favor, la(s) imagen(es) se esta procesando
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2 py-2.5">
                                            @if (isset($empresa['image']) && $empresa['image'])
                                            <img src="{{ Storage::url($empresa['image']['url']) }}" class="mx-auto w-32 h-32 object-cover rounded-md" alt="Imagen de la empresa">
                                            @else
                                            <img src="/img/no_imagen.jpg" class="mx-auto w-32 h-32 object-cover rounded-md" alt="Sin imagen">
                                            @endif
                                            @if ($ruteCreate)
                                            @if ($image)
                                            <img class="mx-auto w-32 h-32 object-cover rounded-md"
                                                src="{{ $image->temporaryUrl() }}" alt="">
                                            @else
                                            <li id="empty"
                                                class="h-full w-full text-center flex flex-col items-center justify-center">
                                                <img class="mx-auto w-32"
                                                    src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                                                    alt="no data" />
                                                <span class="text-small text-gray-500">
                                                    Ningún archivo seleccionado</span>
                                            </li>
                                            @endif
                                            @else
                                            @if ($image)
                                            <img class="mx-auto w-32 h-32 object-cover rounded-md"
                                                src="{{ $image->temporaryUrl() }}" alt="">
                                            @else
                                            <img class="mx-auto w-32 h-32 object-cover rounded-md"
                                                src="/img/default.jpg" alt="">
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-button-danger wire:click="$set('isOpen',false)">Cancelar</x-button-danger>
            <x-button-success wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store, image"
                class="disabled:opacity-25">
                @if ($ruteCreate)
                Registrar
                @else
                Actualizar
                @endif
            </x-button-success>
        </x-slot>

    </x-dialog-modal>
</div>