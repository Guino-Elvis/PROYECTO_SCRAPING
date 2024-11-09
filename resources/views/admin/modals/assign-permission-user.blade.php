<div>
    <x-dialog-modal wire:model="isOpenAssign" maxWidth="lg">
        <x-slot name="title">
            <h3 class="text-center">Asignar rol</h3>
        </x-slot>
        <x-slot name="content">
            <form autocomplete="off">
                <input type="hidden" wire:model="user.id">
                <div class="flex gap-2.5 w-full px-2 items-center">
                    <x-label value="USUARIO:" class="font-bold" />
                    <x-input disabled wire:model="user.name" />
                </div>
                <div class="w-full px-2 mt-4">
                    <x-label value="LISTA DE ROLES:" class="font-bold" />
                    @foreach ($roles as $role)
                        <div class="flex gap-2.5 w-full items-center">
                            <input wire:model="listaRoles" @if ($user->hasAnyRole($role->id)) checked @endif
                                type="checkbox" value="{{ $role->id }}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-white focus:ring-2 duration-400">
                            <label class="ms-2 text-sm font-medium text-gray-900">
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-button-danger wire:click="$set('isOpenAssign',false)">Cancelar</x-button-danger>
            <x-button-success wire:click.prevent="updateRoleUser({{ $user }})" wire:loading.attr="disabled"
                wire:target="store" class="disabled:opacity-25">
                Asignar roles
            </x-button-success>
        </x-slot>

    </x-dialog-modal>
</div>
