<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/img/icono.png" type="image/png">
    <link rel="shortcut icon" href="/img/icono.png">

    <title>INFOTELPERU - Tienda Virtual</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <link rel="stylesheet" href="/css/styles.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<x-sidebar>
    <x-slot name="content">

        @section('title', 'Lista de Postulantes - BOLSALABORAL')
        @section('header', 'Lista de Postulantes')
        @section('section', 'BOLSALABORAL')
        {{-- <div class="flex  items-center justify-start">
            <a href="{{ route('tabla-ofertas-laborales') }}"
                class="flex flex-row items-center justify-start uppercase font-bold  gap-4 py-1 px-4 hover:bg-gray-500 hover:text-white hover:rounded-lg">
                <i class="fa-solid fa-reply-all"></i>
                <div>Regresar</div>
            </a>
        </div> --}}
        <!-- Page Content -->
        <div class="shadow-lg border-b border-gray-200 rounded-lg ">
            <table class="w-full table-auto">
                <tbody class="divide-y divide-gray-300 bg-white">
                    <tr class="text-sm font-medium text-gray-900 hover:bg-gray-100">
                        <td class=" px-6 py-4 text-start ">
                            <div class="flex justify-center items-center bg-blue-400 py-2 rounded-xl text-white">
                                <div class="uppercase">
                                    EMPRESA : {{ $ofertaLaboraldetail->empresa->ra_social }}
                                </div>
                            </div>
                            <div class="flex flex-row gap-4 justify-start items-center py-1 flex-wrap">
                                <div class="bg-green-500 rounded-xl px-10 py-2 text-green-300">
                                    <div class="flex flex-col">
                                        <div class="font-extrabold text-white uppercase">titulo</div>
                                        <div class="flex justify-start items-start">
                                            {{ $ofertaLaboraldetail->titulo }}
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-green-500 rounded-xl px-10 py-2 text-green-300">
                                    <div class="flex flex-col">
                                        <div class="font-extrabold text-white uppercase">ubicacion</div>
                                        <div class="flex justify-start items-start">
                                            {{ $ofertaLaboraldetail->ubicacion }}
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-green-500 rounded-xl px-10 py-2 text-green-300">
                                    <div class="flex flex-col">
                                        <div class="font-extrabold text-white uppercase">Estado</div>
                                        <div class="flex justify-start items-start">
                                            @if ($ofertaLaboraldetail->state == 1)
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
                                    </div>
                                </div>

                                <div class="bg-white shadow-md shadow-gray-300 rounded-xl py-1 px-10">
                                    <div class="flex flex-col">
                                        <div class="font-extrabold text-black uppercase">limite de postulantes
                                        </div>
                                        <div class="flex justify-start items-start">
                                            {{ $ofertaLaboraldetail->aplication->count() }}
                                            /{{ $ofertaLaboraldetail->limite_postulante }}
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white shadow-md shadow-gray-300 rounded-xl py-1 px-10">
                                    <div class="flex flex-col">
                                        <div class="font-extrabold text-black uppercase">remuneracion
                                        </div>
                                        <div class="flex justify-start items-start">
                                            S/ {{ $ofertaLaboraldetail->remuneracion }}</div>
                                    </div>
                                </div>
                                <div class="bg-white shadow-md shadow-gray-300 rounded-xl py-1 px-10">
                                    <div class="flex flex-col">
                                        <div class="font-extrabold text-black uppercase">fecha_inicio :
                                        </div>
                                        <div class="flex justify-start items-start">
                                            {{ $ofertaLaboraldetail->fecha_inicio }}
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white shadow-md shadow-gray-300 rounded-xl py-1 px-10">
                                    <div class="flex flex-col">
                                        <div class="font-extrabold text-black uppercase">fecha_fin :</div>
                                        <div class="flex justify-start items-start">
                                            {{ $ofertaLaboraldetail->fecha_fin }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end pt-10">
                                <div class="font-extrabold text-black uppercase">fecha de Creacion OFERTA LABORAL:
                                </div>
                                <div class="flex justify-start items-start">
                                    {{ $ofertaLaboraldetail->created_at }}</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="shadow-lg border-b border-gray-200 rounded-lg overflow-auto my-5">
            <table class="w-full table-auto">
                <tbody class="divide-y divide-gray-300 bg-white">
                    <tr class="text-sm font-medium text-gray-900 hover:bg-gray-100">
                        <td class=" px-6 py-4 text-start ">
                            <div class="grid grid-cols-2 w-1/4">
                                <div class="font-extrabold text-black uppercase">Detalles De los postulantes
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="shadow-lg border-b border-gray-200 bg-white rounded-lg overflow-auto my-5 py-4 px-6">
            <div class="flex flex-col sm:flex-row sm:justify-between text-center gap-2 mb-4">

                <div class="flex-1">
                    <div class="relative flex items-center text-gray-400 focus-within:text-blue-700">
                        <span class="absolute left-4 h-6 flex items-center pr-3 border-r border-gray-300">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="search" wire:model="search" placeholder="Buscar..."
                            class="w-full pl-14 pr-4 py-2.5 rounded-lg text-sm text-gray-600 outline-none border border-gray-300 focus:border-sky-900 focus:ring-blue-700 shadow-lg">
                    </div>
                </div>
                <div class="flex justify-center gap-2" align="right">
                    <button
                        class="px-4 py-2 flex gap-1 items-center rounded-lg bg-gradient-to-r from-emerald-700 to-green-600 focus:from-emerald-700 focus:to-green-600 active:from-green-600 active:to-green-600 text-sm text-white font-semibold tracking-wide cursor-not-allowed shadow-lg opacity-60"
                        disabled>
                        <i class="fa-regular fa-file-excel"></i> csv
                    </button>
                    <button
                        class="px-4 py-2 flex gap-1 items-center rounded-lg bg-gradient-to-r from-sky-900 to-blue-700 focus:from-sky-900 focus:to-blue-700 active:from-sky-700 active:to-blue-600 text-sm text-white font-semibold tracking-wide cursor-not-allowed shadow-lg opacity-60"
                        disabled>
                        <i class="fa-regular fa-file-lines"></i> Pdf
                    </button>
                </div>
            </div>
            <div class="shadow-lg border-b border-gray-200 rounded-lg overflow-auto">
                <table class="w-full table-auto">
                    <thead class="bg-indigo-700 text-white">
                        <tr class="text-center text-xs font-bold uppercase">
                            <td scope="col" class="px-6 py-3">ID</td>
                            <td scope="col" class="px-6 py-3">numero de postulacion</td>
                            <td scope="col" class="px-6 py-3">estado</td>
                            <td scope="col" class="px-6 py-3">fecha de postulacion</td>
                            <td scope="col" class="px-6 py-3">postulante</td>
                            <td scope="col" class="px-6 py-3">oferta laboral</td>
                            <td scope="col" class="px-6 py-3">Creado</td>
                            <td scope="col" class="px-6 py-3">Actualizado</td>
                            <th scope="col" class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300 bg-white">
                        @foreach ($details as $index => $item)
                            <tr class="text-sm font-medium text-gray-900 hover:bg-gray-100">
                                <td class="p-4">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-700 text-white">
                                        {{ $index + 1 }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">{{ $item->numero }}</td>
                                <td class="p-4 text-center uppercase">
                                    @if ($item->status == 'PE')
                                        <span
                                            class="bg-amber-100 text-amber-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                            PENDIENTE
                                        </span>
                                    @elseif ($item->status == 'AP')
                                        <span
                                            class="bg-green-100 text-green-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                            APROBADO
                                        </span>
                                    @elseif ($item->status == 'RE')
                                        <span
                                            class="bg-red-500 text-white text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                            RECHAZADO
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">{{ $item->fecha_postulacion }}</td>
                                <td class="p-4 text-center">{{ $item->postulante->name }}</td>
                                <td class="p-4 text-center">{{ $ofertaLaboraldetail->empresa->ra_social }}</td>
                                <td class="p-4 text-center">{{ $item->created_at }}</td>
                                <td class="p-4 text-center">{{ $item->updated_at }}</td>
                                <td class="p-4 text-center">
                                    <a href="{{ route('registro-de-postulaciones.show', ['id' => $item->id]) }}"
                                        class="flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-medium text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>

                                    <form method="post" action="{{ url('/aplication/' . $item->id) }}">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button
                                            class="inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-red-700 to-red-600 active:from-red-600 active:to-red-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                            type="button" data-aplications-id="{{ $item->id }}"
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
            @if (!$details->count())
                <div class="flex h-auto items-center justify-center p-5 bg-white w-full rounded-lg shadow-lg">
                    <div class="text-center">
                        <div class="inline-flex rounded-full bg-yellow-100 p-4">
                            <div class="rounded-full text-yellow-600 bg-yellow-200 p-4 text-6xl">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </div>
                        </div>
                        <h1 class="mt-5 text-2xl font-bold text-slate-800">Ups... algo salio mal</h1>
                        <p class="text-slate-600 mt-2 text-base">No existe ningun registro coincidente con
                            la
                            busqueda </p>
                        <span class="text-slate-600 mt-2 text-base">Por favor ingrese el texto
                            correctamente</span>
                    </div>
                </div>
            @endif
            @if ($details->hasPages())
                <div class="px-6 py-3">
                    {{ $details->links() }}
                </div>
            @endif
        </div>

        <script>
            function confirmDelete(button) {
                const id = button.getAttribute('data-aplications-id');

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
                    url: '{{ url('/aplication') }}/' + id,
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

    </x-slot>
</x-sidebar>
