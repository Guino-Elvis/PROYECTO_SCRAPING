@section('title', 'Lista de Empresas - BOLSALABORAL')
@section('header', 'Lista de Empresas')
@section('section', 'BOLSALABORAL')

<div>
    <div>
        <div class="flex flex-col sm:flex-row sm:justify-between text-center gap-2 mb-4">
            <div class="flex-1">
                <div class="relative flex items-center text-gray-400 focus-within:text-green-500">
                    <span class="absolute left-4 h-6 flex items-center pr-3 border-r border-gray-300">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="search" wire:model="search" placeholder="Buscar por nombre..."
                        class="w-full pl-14 pr-4 py-2.5 rounded-lg text-sm text-gray-600 outline-none border border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-lg">
                </div>
            </div>
            <div class="flex justify-center gap-2" align="right">
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
                <a href="{{ URL::to('/empresas/csv') }}"
                    class="px-4 py-2 flex gap-1 items-center rounded-lg bg-gradient-to-r from-emerald-700 to-green-600 focus:from-emerald-700 focus:to-green-600 active:from-green-600 active:to-green-600 text-sm text-white font-semibold tracking-wide cursor-pointer shadow-lg">
                    <i class="fa-regular fa-file-excel"></i> csv
                </a>
                <a href="{{ URL::to('/empresas/excel') }}"
                    class="px-4 py-2 flex gap-1 items-center rounded-lg bg-gradient-to-r from-emerald-700 to-green-600 focus:from-emerald-700 focus:to-green-600 active:from-green-600 active:to-green-600 text-sm text-white font-semibold tracking-wide cursor-pointer shadow-lg">
                    <i class="fa-regular fa-file-excel"></i>excel
                </a>
                <a href="{{ URL::to('/empresas/pdf') }}" target="_blank"
                    class="px-4 py-2 flex gap-1 items-center rounded-lg bg-gradient-to-r from-sky-900 to-blue-700 focus:from-sky-900 focus:to-blue-700 active:from-sky-700 active:to-blue-600 text-sm text-white font-semibold tracking-wide cursor-pointer shadow-lg">
                    <i class="fa-regular fa-file-lines"></i> pdf
                </a>
                @php
                    $user = Auth::user();
                    $userRoleName = $user->roles->first()->name;
                @endphp
                @if ($userRoleName === 'Administrador')
                    <button wire:click="create()"
                        class="px-4 py-2 rounded-lg bg-gradient-to-r from-amber-700 to-yellow-600 focus:from-amber-700 focus:to-yellow-600 active:from-amber-600 active:to-yellow-600 text-sm text-white font-semibold tracking-wide cursor-pointer shadow-lg">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                @else
                   <span></span>
                @endif

                @if ($isOpen)
                    @include('admin.modals.empresas')
                @endif
            </div>
        </div>
        <div class="shadow-lg border-b border-gray-200 rounded-lg overflow-auto">
            <table class="w-full table-auto">
                <thead class="bg-indigo-700 text-white">
                    <tr class="text-center text-xs font-bold uppercase">
                        <td scope="col" class="px-6 py-3">ID</td>
                        <td scope="col" class="px-6 py-3">Razon Social</td>
                        <td scope="col" class="px-6 py-3">Logo Empresa</td>
                        <td scope="col" class="px-6 py-3">RUC</td>
                        <td scope="col" class="px-6 py-3">Direccion</td>
                        <td scope="col" class="px-6 py-3">Correo</td>
                        <td scope="col" class="px-6 py-3">Telefono</td>
                        <td scope="col" class="px-6 py-3">Usuario</td>
                        <td scope="col" class="px-6 py-3">ROL USUARIO</td>
                        <td scope="col" class="px-6 py-3">Creacion</td>
                        <td scope="col" class="px-6 py-3">Actualizado</td>
                        <th scope="col" class="px-4 py-3 ">acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 bg-white">
                    @foreach ($empresas as $index => $item)
                        <tr class="text-sm font-medium text-gray-900 hover:bg-gray-100">
                            <td class="p-4">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-700 text-white">
                                    {{ $index + 1 }}
                                </span>
                            </td>
                            <td class="p-4 text-center">{{ $item->ra_social }}</td>
                            <td class="p-2">
                                <img class="w-24 h-24 object-cover rounded-lg"
                                    src="{{ $item->image ? Storage::url($item->image->url) : '/img/default.jpg' }}" />
                            </td>

                            <td class="p-4 text-center">{{ $item->ruc }}</td>
                            <td class="p-4 text-center">{{ $item->direccion }}</td>
                            <td class="p-4 text-center">{{ $item->correo }}</td>
                            <td class="p-4 text-center">{{ $item->telefono }}</td>
                            <td class="p-4 text-center">{{ $item->user->name }}</td>
                            @foreach ($item->user->roles as $role)
                                <td class="p-4 text-center">
                                    {{ $role->name }}
                                </td>
                            @endforeach
                            <td class="p-4 text-center">{{ $item->created_at }}</td>
                            <td class="p-4 text-center">{{ $item->updated_at }}</td>
                            <td class="p-2 w-10 acciones">

                                @php
                                    $user = Auth::user();
                                    $userRoleName = $user->roles->first()->name;
                                @endphp
                                @if ($userRoleName === 'Administrador')
                                    <x-button-success wire:click="edit({{ $item }})">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </x-button-success>
                                    <form method="post" action="{{ url('/empresa/' . $item->id) }}">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button
                                            class="inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-red-700 to-red-600 active:from-red-600 active:to-red-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                            type="button" data-empresas-id="{{ $item->id }}"
                                            onclick="confirmDelete(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="#"
                                        class="flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-medium text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (!$empresas->count())
            <div class="flex h-auto items-center justify-center p-5 bg-white w-full rounded-lg shadow-lg">
                <div class="text-center">
                    <div class="inline-flex rounded-full bg-yellow-100 p-4">
                        <div class="rounded-full text-yellow-600 bg-yellow-200 p-4 text-6xl">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                    </div>
                    <h1 class="mt-5 text-2xl font-bold text-slate-800">Ups... algo salio mal</h1>
                    <p class="text-slate-600 mt-2 text-base">No existe ningun registro coincidente con la busqueda </p>
                    <span class="text-slate-600 mt-2 text-base">Por favor ingrese el texto correctamente</span>
                </div>
            </div>
        @endif
        @if ($empresas->hasPages())
            <div class="px-6 py-3">
                {{ $empresas->links() }}
            </div>
        @endif
    </div>


    <script>
        function confirmDelete(button) {
            const id = button.getAttribute('data-empresas-id');

            Swal.fire({
                title: 'Confirmar eliminación',
                text: '¿Está seguro de eliminar este item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteRecord(id);
                }
            });
        }

        function deleteRecord(id) {
            $.ajax({
                type: 'POST',
                url: '{{ url('/empresa') }}/' + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "_method": "DELETE"
                },
                success: function(data) {
                    if (data.success) {

                    }
                    location.reload(); // Recargar la página, por ejemplo
                }
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</div>
