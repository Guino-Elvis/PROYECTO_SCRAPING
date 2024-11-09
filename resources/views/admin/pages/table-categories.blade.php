@section('title', 'Tabla - Categorias')
@section('header', 'Tabla')
@section('section', 'Categorias')

<div>
    <div>
        @if ($isOpen)
            @include('admin.modals.category')
        @endif
        <x-card>
            <div class="flex flex-col sm:flex-row sm:justify-between text-center gap-2 mb-4">
                <div class="flex-1">
                    <x-search />
                </div>
                <div x-data="{ open: false }" @click.away="open = false" class="flex flex-wrap justify-center gap-2"
                    align="right">
                    <x-select wire:model="amount" class="w-max">
                        <x-slot name="options">
                            <option value="5" selected>5</option>
                            <option value="10">10</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="70">70</option>
                            <option value="100">100</option>
                        </x-slot>
                    </x-select>

                    <x-button-default @click="open = ! open" id="dropdownBottomButton"
                        data-dropdown-toggle="dropdownBottom" data-dropdown-placement="bottom" type="button">
                        <i class="fa-solid fa-file-export me-1"></i>
                        Exportar
                        <i class="fa-solid fa-chevron-right ms-2 transition-transform duration-200 transform"
                            :class="{ 'rotate-90': open, 'rotate-0': !open }"></i>
                    </x-button-default>

                    <!-- Dropdown menu -->
                    <div id="dropdownBottom" class="z-10 hidden bg-white rounded-lg shadow-lg w-40 border">
                        <div class="py-2 text-sm font-medium text-zinc-700" aria-labelledby="dropdownBottomButton">
                            <x-button-hover color="green" wire:click="createCSV()" target="_blank">
                                <i class="fa-solid fa-file-csv"></i> CSV
                            </x-button-hover>
                            <x-button-hover color="green" wire:click="createExcel()" target="_blank">
                                <i class="fa-solid fa-file-excel me-1"></i> EXCEL
                            </x-button-hover>
                            <a href="{{ URL::to('/categorias/pdf') }}" target="_blank">
                                <x-button-hover color="blue">
                                    <i class="fa-solid fa-file-pdf"></i> PDF
                                </x-button-hover>
                            </a>
                        </div>
                    </div>
                    <x-button wire:click="create()">
                        <i class="fa-solid fa-plus me-1"></i>
                        Agregar categoria
                    </x-button>
                </div>
            </div>
            <div class="shadow border-b border-gray-200 rounded-lg overflow-auto">
                <table class="w-full table-auto">
                    <thead class="bg-indigo-600 text-white">
                        <tr class="text-center text-xs font-bold uppercase">
                            <td scope="col" class="px-6 py-3">ID</td>
                            <td scope="col" class="px-6 py-3">Imagen</td>
                            <td scope="col" class="px-6 py-3">Nombre</td>
                            <td scope="col" class="px-6 py-3">Slug</td>
                            <td scope="col" class="px-6 py-3">Estado</td>
                            <td scope="col" class="px-6 py-3">Usuario</td>
                            <td scope="col" class="px-6 py-3">Creado</td>
                            <td scope="col" class="px-6 py-3">Actualizado</td>
                            <th scope="col" class="px-4 py-3 acciones"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300 bg-white">
                        @foreach ($categories as $category)
                            <tr class="text-sm font-medium text-gray-900 hover:bg-gray-100">
                                <td class="px-4 py-2">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-600 text-white">
                                        {{ $category->id }}
                                    </span>
                                </td>
                                <td class="p-2">
                                    <img class="w-24 h-24 object-cover rounded-lg"
                                        src="{{ $category->image ? Storage::url($category->image->url) : '/img/default.jpg' }}" />
                                </td>
                                <td class="px-4 py-2 text-center">{{ $category->name }}</td>
                                <td class="px-4 py-2 text-center">{{ $category->slug }}</td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex justify-center items-center">
                                        @if ($category->state == 1)
                                            <span
                                                class="bg-amber-100 text-amber-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                Escondido
                                            </span>
                                        @else
                                            <span
                                                class="bg-green-100 text-green-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                Visible
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-center">{{ $category->user->name }}</td>
                                <td class="px-4 py-2 text-center">{{ $category->created_at }}</td>
                                <td class="px-4 py-2 text-center">{{ $category->updated_at }}</td>
                                <td class="px-4 py-2 acciones w-10 space-y-2">
                                    <x-button-success wire:click="edit({{ $category }})">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </x-button-success>
                                    <x-button-danger wire:click="$emit('deleteItem',{{ $category->id }})">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </x-button-danger>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($categories->count() == 0 && $search == '')
                <div class="text-center pt-4">
                    <span class="text-slate-600 mt-2 text-sm">Ningún dato disponible en esta tabla</span>
                </div>
            @elseif ($categories->count() == 0 && $search != '')
                <div class="flex h-auto items-center justify-center p-5 bg-white w-full rounded-lg shadow-lg">
                    <div class="text-center">
                        <div class="inline-flex rounded-full bg-yellow-100 p-4">
                            <div class="rounded-full text-yellow-600 bg-yellow-200 p-4 text-6xl">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </div>
                        </div>
                        <h1 class="mt-5 text-2xl font-bold text-slate-800">Ups... algo salio mal</h1>
                        <p class="text-slate-600 mt-2 text-base">No existe ningun registro coincidente con la busqueda
                        </p>
                        <span class="text-slate-600 mt-2 text-base">Por favor ingrese el texto correctamente</span>
                    </div>
                </div>
            @endif
            @if ($categories->hasPages())
                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            @endif
        </x-card>

    </div>

    <!--Scripts - Sweetalert   -->
    @push('js')
        <script>
            Livewire.on('deleteItem', id => {
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórralo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //alert("del");
                        Livewire.emitTo('table-categories', 'delete', id);
                        Swal.fire(
                            '¡Eliminado!',
                            'Su archivo ha sido eliminado.',
                            'success'
                        )

                    }
                })
            });
        </script>
    @endpush
</div>
