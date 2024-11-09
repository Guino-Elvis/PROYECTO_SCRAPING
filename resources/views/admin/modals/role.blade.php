<div>
    <x-dialog-modal wire:model="isOpen" maxWidth="lg">
        <x-slot name="title">
            @if ($ruteCreate)
                <h3 class="text-center">Registrar nuevo rol</h3>
            @else
                <h3 class="text-center">Actualizar rol</h3>
            @endif
        </x-slot>
        <x-slot name="content">
            <form autocomplete="off" wire:keydown.enter.prevent="store()">
                <input type="hidden" wire:model="role.id">
                <div class="flex flex-col gap-2.5 w-full px-2">
                    <div class="mb-1">
                        <x-label value="Nombre" class="font-bold" />
                        <x-input type="text" wire:model="role.name" />
                        @unless (!empty($role['name']))
                            <x-input-error for="role.name" />
                        @endunless
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-button-danger wire:click="$set('isOpen',false)">Cancelar</x-button-danger>
            <x-button-success wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store"
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
