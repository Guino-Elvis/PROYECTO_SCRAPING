@section('title', 'Lista de Postulantes - BOLSALABORAL')
@section('header', 'Lista de Postulantes')
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
                        <td scope="col" class="px-6 py-3">Email</td>
                        <td scope="col" class="px-6 py-3">Telefono</td>
                        <td scope="col" class="px-6 py-3">Nombre</td>
                        <td scope="col" class="px-6 py-3">Apellido paterno</td>
                        <td scope="col" class="px-6 py-3">Apellido materno</td>
                        <td scope="col" class="px-6 py-3">Dirección</td>
                        <td scope="col" class="px-6 py-3">DNI</td>
                        <td scope="col" class="px-6 py-3">Codigo postal</td>
                        <td scope="col" class="px-6 py-3">T datos</td>
                        <td scope="col" class="px-6 py-3">Creado</td>
                        <td scope="col" class="px-6 py-3">Actualizado</td>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 bg-white">
                    @foreach ($postulantes as $index => $client)
                        <tr class="text-sm font-medium text-gray-900 hover:bg-gray-100">
                            <td class="p-4">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-700 text-white">
                                    {{ $index + 1 }}
                                </span>
                            </td>
                            <td class="p-4 text-center">{{ $client->email }}</td>
                            <td class="p-4 text-center">{{ $client->phone }}</td>
                            <td class="p-4 text-center">{{ $client->name }}</td>
                            <td class="p-4 text-center">{{ $client->paterno }}</td>
                            <td class="p-4 text-center">{{ $client->materno }}</td>
                            <td class="p-4 text-center">{{ $client->address }}</td>
                            <td class="p-4 text-center">{{ $client->document }}</td>
                            <td class="p-4 text-center">{{ $client->postal }}</td>
                            <td class="p-4 text-center">{{ $client->tdatos }}</td>
                            <td class="p-4 text-center">{{ $client->created_at }}</td>
                            <td class="p-4 text-center">{{ $client->updated_at }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (!$postulantes->count())
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
        @if ($postulantes->hasPages())
            <div class="px-6 py-3">
                {{ $postulantes->links() }}
            </div>
        @endif
    </div>
</div>
