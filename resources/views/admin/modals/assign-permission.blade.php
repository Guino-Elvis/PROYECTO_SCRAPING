<div>
    <x-dialog-modal wire:model="isOpenAssign" maxWidth="lg">
        <x-slot name="title">
            <h3 class="text-center">Asignar permiso</h3>
        </x-slot>
        <x-slot name="content">
            <form autocomplete="off">
                <input type="hidden" wire:model="role.id">
                <div class="flex gap-2.5 w-full px-2 items-center">
                    <x-label value="ROL:" class="font-bold" />
                    <x-input disabled wire:model="role.name" />
                </div>
                <div class="w-full px-2 mt-4">
                    <x-label value="LISTA DE PERMISOS:" class="font-bold" />
                    @foreach ($permissions as $permission)
                        <div class="flex gap-2.5 w-full items-center">
                          
                             <input wire:model="listapermisos" type="checkbox" value="{{ $permission->id }}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-white focus:ring-2 duration-400">
                            <label class="ms-2 text-sm font-medium text-gray-900">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-button-danger wire:click="$set('isOpenAssign',false)">Cancelar</x-button-danger>
            <x-button-success wire:click.prevent="updateRolePermissions({{ $role }})" wire:loading.attr="disabled"
                wire:target="store" class="disabled:opacity-25">
                Asignar permisos
            </x-button-success>
        </x-slot>

    </x-dialog-modal>
</div>


 