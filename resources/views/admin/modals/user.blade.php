<div>
    <x-dialog-modal wire:model="isOpen" maxWidth="lg">
        <x-slot name="title">
            @if ($ruteCreate)
                <h3 class="text-center">Registrar nueva categoria</h3>
            @else
                <h3 class="text-center">Actualizar categoria</h3>
            @endif
        </x-slot>
        <x-slot name="content">
            <form autocomplete="off">
                <input type="hidden" wire:model="user.id">
                <div class="flex flex-col gap-2.5 w-full px-2 ">
                    <div class="flex flex-row gap-4 justify-center">
                        <div class="mb-1">
                            <x-label value="Nombre" class="font-bold" />
                            <x-input type="text" wire:model="user.name" />
                            @unless (!empty($user['name']))
                                <x-input-error for="user.name" />
                            @endunless
                        </div>
                        <div>
                            <x-label value="Correo" class="font-bold" />
                            <x-input type="text" wire:model="user.email" />
                            @unless (!empty($user['email']))
                                <x-input-error for="user.email" />
                            @endunless
                        </div>
                    </div>



                    <div class="flex flex-row gap-4 justify-center">
                        <div>
                            <x-label value="Apellido Paterno" class="font-bold" />
                            <x-input type="text" wire:model="user.apellido_p" />
                            @unless (!empty($user['apellido_p']))
                                <x-input-error for="user.apellido_p" />
                            @endunless
                        </div>
                        <div>
                            <x-label value="Apellido Materno" class="font-bold" />
                            <x-input type="text" wire:model="user.apellido_m" />
                            @unless (!empty($user['apellido_m']))
                                <x-input-error for="user.apellido_m" />
                            @endunless
                        </div>
                    </div>
                    <div class="flex  justify-center">
                        <div class="w-full px-6">
                            <x-label value="Direccion" class="font-bold" />
                            <x-input class="w-full" type="text" wire:model="user.direccion" />
                            @unless (!empty($user['direccion']))
                                <x-input-error for="user.direccion" />
                            @endunless
                        </div>
                    </div>
                    <div class="flex flex-row gap-4 justify-center">
                        <div>
                            <x-label value="DNI" class="font-bold" />
                            <x-input type="text" wire:model="user.dni" />
                            @unless (!empty($user['dni']))
                                <x-input-error for="user.dni" />
                            @endunless
                        </div>
                        <div>
                            <x-label value="Telefono" class="font-bold" />
                            <x-input type="text" wire:model="user.telefono" />
                            @unless (!empty($user['telefono']))
                                <x-input-error for="user.telefono" />
                            @endunless
                        </div>

                    </div>




                    <div class="px-6">
                        <x-label value="Nueva Contraseña" class="font-bold" />
                        <div class="relative" x-data="{ showPas: false }">
                            <input type="password" wire:model="user.password" placeholder="••••••••"
                                :type="showPas ? 'text' : 'password'"
                                class="text-sm w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm">
                                <div class="h-5 text-gray-700 py-0.5" @click="showPas = !showPas"
                                    :class="{ 'block': !showPas, 'hidden': showPas }">
                                    <i class="fa-solid fa-eye fa-lg"></i>
                                </div>
                                <div class="h-5 text-gray-700 py-0.5" @click="showPas = !showPas"
                                    :class="{ 'hidden': !showPas, 'block': showPas }">
                                    <i class="fa-solid fa-eye-slash fa-lg"></i>
                                </div>
                            </div>
                        </div>
                        @unless (!empty($user['password']))
                            <x-input-error for="user.password" />
                        @endunless
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
