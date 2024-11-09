@section('title', 'Lista de Ofertas Laborales - OFERTA LABORAL')
@section('header', 'Lista de Ofertas Laborales')
@section('section', 'oferta LABORAL')

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
                <a href="{{ URL::to('/ofertas_laborales/csv') }}"
                    class="px-4 py-2 flex gap-1 items-center rounded-lg bg-gradient-to-r from-emerald-700 to-green-600 focus:from-emerald-700 focus:to-green-600 active:from-green-600 active:to-green-600 text-sm text-white font-semibold tracking-wide cursor-pointer shadow-lg">
                    <i class="fa-regular fa-file-excel"></i> csv
                </a>
                <a href="{{ URL::to('/ofertas_laborales/excel') }}"
                    class="px-4 py-2 flex gap-1 items-center rounded-lg bg-gradient-to-r from-emerald-700 to-green-600 focus:from-emerald-700 focus:to-green-600 active:from-green-600 active:to-green-600 text-sm text-white font-semibold tracking-wide cursor-pointer shadow-lg">
                    <i class="fa-regular fa-file-excel"></i>excel
                </a>
                <a href="{{ URL::to('/ofertas_laborales/pdf') }}" target="_blank"
                    class="px-4 py-2 flex gap-1 items-center rounded-lg bg-gradient-to-r from-sky-900 to-blue-700 focus:from-sky-900 focus:to-blue-700 active:from-sky-700 active:to-blue-600 text-sm text-white font-semibold tracking-wide cursor-pointer shadow-lg">
                    <i class="fa-regular fa-file-lines"></i> pdf
                </a>

                <button wire:click="create()"
                    class="px-4 py-2 rounded-lg bg-gradient-to-r from-amber-700 to-yellow-600 focus:from-amber-700 focus:to-yellow-600 active:from-amber-600 active:to-yellow-600 text-sm text-white font-semibold tracking-wide cursor-pointer shadow-lg">
                    <i class="fa-solid fa-plus"></i> Nuevo
                </button>
                @if ($isOpen)
                    @include('admin.modals.oferta-laboral')
                @endif
                @include('admin.modals.modal-pdf')
            </div>
        </div>
        <div class="shadow-lg border-b border-gray-200 rounded-lg overflow-auto">
            <table class="w-full table-auto">
                <thead class="bg-indigo-700 text-white">
                    <tr class="text-center text-xs font-bold uppercase">
                        <td scope="col" class="px-6 py-3">ID</td>
                        <td scope="col" class="px-6 py-3">titulo</td>
                        <td scope="col" class="px-6 py-3">ubicacion</td>
                        <td scope="col" class="px-6 py-3">Estado</td>
                        <td scope="col" class="px-6 py-3">remuneracion</td>
                        <td scope="col" class="px-6 py-3">fecha_inicio</td>
                        <td scope="col" class="px-6 py-3">fecha_fin</td>
                        <td scope="col" class="px-6 py-3">limite de postulantes</td>
                        <td scope="col" class="px-6 py-3">Postulaciones</td>
                        <td scope="col" class="px-6 py-3">Empresa</td>
                        <td scope="col" class="px-6 py-3">Usuario</td>
                        <td scope="col" class="px-6 py-3">Creacion</td>
                        <td scope="col" class="px-6 py-3">Actualizado</td>
                        <th scope="col" class="px-4 py-3 ">acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 bg-white">
                    @foreach ($ofertaLaborals as $index => $ofertaLaboral)
                        <tr class="text-sm font-medium text-gray-900 hover:bg-gray-100">
                            <td class="p-4">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-700 text-white">
                                    {{ $index + 1 }}
                                </span>
                            </td>
                            <td class="p-4 text-center">{{ $ofertaLaboral->titulo }}</td>
                            <td class="p-4 text-center">{{ $ofertaLaboral->ubicacion }}</td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center ofertaLaborals-center">
                                    @if ($ofertaLaboral->state == 1)
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
                            <td class="p-4 text-center">{{ $ofertaLaboral->remuneracion }}</td>
                            <td class="p-4 text-center">{{ $ofertaLaboral->fecha_inicio }}</td>
                            <td class="p-4 text-center">{{ $ofertaLaboral->fecha_fin }}</td>
                            <td class="p-4 text-center">{{ $ofertaLaboral->limite_postulante }}</td>
                            <td class="p-4 text-center hover:text-blue-700">
                                @if ($ofertaLaboral->aplication->count() === 0)
                                    <a href="{{ route('oferta-laboral.show', ['id' => $ofertaLaboral->id]) }}">
                                        <p>Aun no hay postulantes</p>
                                    </a>
                                @else
                                    <a href="{{ route('oferta-laboral.show', ['id' => $ofertaLaboral->id]) }}">
                                        <p>Total de postulantes {{ $ofertaLaboral->aplication->count() }}</p>
                                    </a>
                                @endif
                            </td>
                            <td class="p-4 text-center">{{ $ofertaLaboral->empresa->ra_social }}</td>
                            {{-- <td class="p-4 text-center">{{ $ofertaLaboral->category->name }}</td> --}}
                            <td class="p-4 text-center">{{ $ofertaLaboral->user->name }}</td>

                            <td class="p-4 text-center">{{ $ofertaLaboral->created_at }}</td>
                            <td class="p-4 text-center">{{ $ofertaLaboral->updated_at }}</td>
                            <td class="p-4 acciones w-10 space-y-2">
                                {{-- @livewire('cliente-edit',['cliente'=>$ofertaLaboralo],key($ofertaLaboralo->id)) --}}
                                <x-button-success wire:click="edit({{ $ofertaLaboral }})">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </x-button-success>
                                <form method="post" action="{{ url('/oferta_laboral/' . $ofertaLaboral->id) }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button
                                        class="inline-flex ofertaLaborals-center justify-center px-3 py-2 bg-gradient-to-r from-red-700 to-red-600 active:from-red-600 active:to-red-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        type="button" data-oferta-laboral-id="{{ $ofertaLaboral->id }}"
                                        onclick="confirmDelete(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (!$ofertaLaborals->count())
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
        @if ($ofertaLaborals->hasPages())
            <div class="px-6 py-3">
                {{ $ofertaLaborals->links() }}
            </div>
        @endif
    </div>


    <script>
        function confirmDelete(button) {
            const id = button.getAttribute('data-oferta-laboral-id');

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
                url: '{{ url('/oferta_laboral') }}/' + id,
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
