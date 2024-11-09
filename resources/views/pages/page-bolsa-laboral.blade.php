<div class="flex flex-col bg-white">
    <div class=" justify-center items-center flex w-full">
        <div class=" py-6 xl:w-2/4 md:w-auto w-auto">
            <div class=" flex flex-row text-lg gap-0.5 border border-gray-400  rounded-lg shadow-md shadow-gray-400">
                <div class="relative flex w-5/12">
                    <span class="absolute left-5 top-5 flex items-center">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="search" wire:model="search" placeholder="Título del empleo, palabras clave o empresa"
                        class="w-full pl-14 rounded-l-lg py-4 border-none outline-none   text-ellipsis">
                </div>
                <div class="flex justify-center items-center">
                    <span class="border-e h-8  border-gray-400"></span>
                </div>
                <div class="relative flex w-5/12">
                    <span class="absolute left-5 top-5 flex items-center">
                        <i class="fa-solid fa-location-dot"></i>
                    </span>
                    <input type="search" wire:model="search"
                        placeholder="Ciudad, región, código postal o trabajo remoto"
                        class="w-full pl-14 rounded-r-lg py-4 border-none outline-none text-ellipsis">
                </div>
                <div class="my-2 mx-1 w-2/12 justify-center items-center flex">
                    <button
                        class="xl:px-6 md:px-6 sm:px-6 px-2 py-3 bg-[#164081] text-sm font-bold text-white rounded-md
                xl:text-base md:text-sm sm:text-xs text-xs xl:truncate md:truncate sm:truncate">
                        Buscar Empleos
                    </button>
                </div>

            </div>
        </div>
    </div>
    <div class="flex justify-center items-center">
        <div class="flex flex-row text-lg gap-0.5 pb-8">
            <a href=""
                class="font-bold text-blue-800 text-sm font-bold
                xl:text-base md:text-sm sm:text-xs text-xs xl:truncate md:truncate sm:truncate">Publica
                tu CV -</a>
            <h1
                class="text-sm font-bold
                xl:text-base md:text-sm sm:text-xs text-xs xl:truncate md:truncate sm:truncate">
                Postúlate a empleos fácilmente</h1>
        </div>
    </div>
    <div class="font-bold flex justify-center items-center border-b border-gray-400">
        <div class="flex flex-row">
            <a href=""
                class="px-20 border-b-4 border-blue-700 hover:border-black text-sm font-bold
                xl:text-base md:text-sm sm:text-xs text-xs xl:truncate md:truncate sm:truncate">Feed
                de empleo</a>
            <a href=""
                class="px-20 border-b border-transparent hover:border-black text-sm font-bold
                xl:text-base md:text-sm sm:text-xs text-xs xl:truncate md:truncate sm:truncate">Búsquedas
                recientes</a>
        </div>
    </div>

    @if ($ofertas->isEmpty())
    @include('errors.error-list')
    @else
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            <div class="flex flex-col gap-2">
                @foreach ($ofertas as $item)
                <div wire:click="obtenerDetallesOferta({{ $item->id }})"
                    class="
                        scale-100 p-6 bg-white border-2 from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20  motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500 ">
                    <div class="">
                        <div class="flex justify-between">
                            <div class="flex flex-row gap-5">
                                <div class="flex flex-row gap-2 w-11/12">
                                    <div class="flex justify-center items-center">
                                        <span
                                            class="bg-gray-200 rounded-md px-2 py-1 text-gray-600 text-sm font-bold ">nuevo
                                            empleo</span>
                                    </div>
                                    <div class="flex justify-center items-center">

                                        <span
                                            class="bg-gray-200 rounded-md px-2 py-1 text-gray-600 text-sm font-bold ">
                                            <i class="fa-solid fa-building"></i> {{ $item->empresa->category->name }}
                                        </span>
                                    </div>
                                </div>
                                <!-- <div class="shadow-md shadow-gray-500 rounded-md px-2 py-1">
                                            <img src="{{ $item->empresa->image ? Storage::url($item->empresa->image->url) : '/img/no_imagen.jpg' }}"
                                                class="max-w-[5rem]" alt="">
                                        </div> -->
                                <div class="shadow-md shadow-gray-500 rounded-md px-2 py-1">
                                    @if ($item->empresa->whatsap === 'N/A')
                                    <img src="../img/no_imagen.jpg" class="max-w-[5rem]" alt="">
                                    @else
                                    <img src="{{ $item->empresa->whatsap }}" class="max-w-[5rem]" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class=" w-1/12">
                                <span
                                    class="text-xl text-gray-600 px-4 py-2 flex justify-center items-center bg-transparent hover:bg-gray-200 hover:rounded-md hover:text-black ">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>

                                </span>
                            </div>
                        </div>

                        <h2 class="mt-6 text-xl font-semibold text-gray-900 text-start">{{ $item->titulo }}
                        </h2>




                        <div class="flex fle-row justify-start items-center pt-2 gap-2">
                            <span class="flex justify-start items-center text-sm ">{{ $item->compania }}</span>
                            <samp class="font-bold text-sm ">5.0<i class="fa-solid fa-star fa-xs "></i></samp>
                        </div>
                        <span class="flex justify-start items-center text-sm ">{{ $item->ubicacion }} </span>
                        <div class="flex fle-row gap-2 justify-start items-center pt-2">
                            <div class="flex fle-row gap-2 font-bold bg-green-200 rounded-md py-1 px-2">
                                <span
                                    class="flex justify-start items-center text-sm ">{{ $item->remuneracion }}</span>
                                <samp><i class="fa-solid fa-heart"></i></samp>
                            </div>
                            <div class="flex fle-row gap-2 font-bold bg-gray-200 rounded-md py-1.5 px-2">
                                <span class="flex justify-start items-center text-sm gap-1">
                                    <i class="fa-solid fa-building"></i> {{ $item->tipo }}
                                </span>
                            </div>
                        </div>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="py-5">
                                        <div class="flex flex-row gap-1">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" focusable="false"
                                                    role="img" fill="#2557A7" viewBox="0 0 24 24"
                                                    aria-hidden="true" class="w-6 h-6">
                                                    <path
                                                        d="M2.344 4.018a.25.25 0 00-.33.31l1.897 5.895a.5.5 0 00.371.335l7.72 1.44-7.72 1.44a.5.5 0 00-.371.335l-1.898 5.896a.25.25 0 00.33.31l19.494-7.749a.25.25 0 000-.464L2.344 4.018z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span>Postulación vía Indeed</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pb-5 text-gray-500">
                                        <ul class="list-disc mt-0 mb-5 pl-5">
                                            <li class="mb-0 text-start line-clamp-2">{{ $item->descripcion }}
                                            </li>

                                            <li class="text-start">
                                                <p class="line-clamp-3"> {{ $item->body }}</p>
                                            </li>
                                        </ul>
                                        <span>
                                            <div class="text-sm text-start">Activo hace 2 días</div>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
                <!-- Indicador de "Cargando..." y botón de "Cargar más" -->
                @if ($loadingMore)
                <p>Cargando más resultados...</p>
                @elseif ($noMoreResults)
                <p>No hay más resultados.</p>
                @else
                <button wire:click="cargarMas" class="btn btn-primary">Cargar más</button>
                @endif
            </div>
            <div class="relative">
                <div class="sticky top-24 z-50">
                    <div
                        class="flex flex-col scale-100 bg-white border-2 from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        @if ($primerDetalle)
                        @include('pages.detalles-oferta', ['detalles' => $primerDetalle])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>