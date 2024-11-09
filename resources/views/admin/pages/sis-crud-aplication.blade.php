@section('title', 'Lista de itemes - BOLSALABORAL')
@section('header', 'Lista de itemes')
@section('section', 'BOLSALABORAL')

<div>
    <div>
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
                        <td scope="col" class="px-6 py-3">numero</td>
                        <td scope="col" class="px-6 py-3">status</td>
                        <td scope="col" class="px-6 py-3">fecha_postulacion</td>
                        <td scope="col" class="px-6 py-3">documentos</td>
                        <td scope="col" class="px-6 py-3">postulante</td>
                        <td scope="col" class="px-6 py-3">oferta laboral</td>

                        <td scope="col" class="px-6 py-3">Creado</td>
                        <td scope="col" class="px-6 py-3">Actualizado</td>
                        <td scope="col" class="px-6 py-3">Acciones</td>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 bg-white">
                    @foreach ($aplicaciones as $item)
                        <tr class="text-sm font-medium text-gray-900 hover:bg-gray-100">
                            <td class="p-4">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-700 text-white">
                                    {{ $item->id }}
                                </span>
                            </td>
                            <td class="p-4 text-center">{{ $item->numero }}</td>
                            <td class="p-4 text-center">{{ $item->status }}</td>
                            <td class="p-4 text-center">{{ $item->fecha_postulacion }}</td>
                            <td class="p-4 text-center">{{ $item->documentos }}</td>
                            <td class="p-4 text-center">
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-500"> {{ $item->postulante->name }},{{ $item->postulante->paterno }},{{ $item->postulante->materno }}</span>
                                    <span class="font-bold text-black text-xs"> {{ $item->postulante->email }}</span>
                                </div>
                            </td>
                            <td class="p-4 text-center">{{ $item->oferta_laboral->titulo }}</td>
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
        @if (!$aplicaciones->count())
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
        @if ($aplicaciones->hasPages())
            <div class="px-6 py-3">
                {{ $aplicaciones->links() }}
            </div>
        @endif
    </div>
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
