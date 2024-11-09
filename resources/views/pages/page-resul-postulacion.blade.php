<div class="flex flex-col bg-white py-10">
    <div class="w-11/12 lg:w-2/6 mx-[auto] pb-5">
        <div class=" h-1 flex  pl-10 sm:pl-0 xl:pl-40 ">
            <div class="w-1/3 bg-indigo-700 h-1 flex items-center">
                <div class="bg-indigo-700 h-6 w-6 rounded-full shadow flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="18"
                        height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M5 12l5 5l10 -10" />
                    </svg>
                </div>
            </div>
            <div class="w-1/3 flex justify-between bg-indigo-700 h-1 items-center relative">
                <div class="bg-indigo-700 h-6 w-6 rounded-full shadow flex items-center justify-center -ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="18"
                        height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M5 12l5 5l10 -10" />
                    </svg>
                </div>
                <div class="bg-white h-6 w-6 rounded-full shadow flex items-center justify-center -mr-3 relative">
                    <div class="h-3 w-3 animate-pulse bg-indigo-700 rounded-full"></div>
                </div>
            </div>
            <div class="w-1/3 flex justify-end">
            </div>
        </div>
    </div>
    <div class="flex justify-center items-center">

        <div class="flex px-20 py-10 gap-2 justify-center">
            <div class="flex-row space-y-2">
                @if (session('statusMessage'))
                    @php
                        $statusTypeClass = session('statusType') === 'success' ? 'bg-green-500' : 'bg-red-500';
                        $iconClass = session('statusType') === 'success' ? 'fa-check' : 'fa-face-sad-tear';
                    @endphp
                    <div class="bg-white px-2 py-2 rounded-lg shadow-md shadow-gray-400">
                        <div class="text-white {{ $statusTypeClass }} rounded-lg p-5">
                            <div class="flex items-center space-x-4 justify-center">
                                <div class="cursor-pointer space-x-2 px-3 py-3 bg-white rounded-full">
                                    <i
                                        class="fa-solid {{ $iconClass }} text-{{ $statusTypeClass === 'bg-green-500' ? 'green' : 'red' }}-500 fa-xl"></i>
                                </div>
                            </div>
                            <span class="font-extrabold text-xl flex items-center space-x-4 justify-center">
                                {{ session('statusMessage') }}
                            </span>

                        </div>
                        <div class="flex items-center space-x-4 justify-center flex-col">
                            <div>

                                @if ($aplications)
                                    <p>Numebre del postulante: {{ $aplications->postulante->name }}{{ $aplications->postulante->paterno }}{{ $aplications->postulante->materno }}</p>
                                    <p>Numero de la aplicación: {{ $aplications->numero }}</p>
                                    {{-- <p>Empresa: {{ $aplications->of_laboral->empresa->ra_zocial }}</p> --}}
                                    <p>Oferta Laboral: {{ $aplications->oferta_laboral->titulo }}</p>
                                    @if ($aplications->status === 'PE')
                                        <p class="text-green-500">Estado: Pendiente</p>
                                    @elseif ($aplications->status === 'RE')
                                        <p class="text-red-500">Estado: Reprobado</p>
                                    @endif
                                    <!-- Mostrar otros detalles de la aplicación según sea necesario -->
                                @else
                                    <p>No se encontró ninguna aplicación.</p>
                                @endif
                            </div>
                            <div class="mt-4 w-64">
                                <div
                                    class="grid  gap-4">
                                    <a href="/"
                                        class="border px-4 py-2 rounded-md text-center">{{ trans('Volver al inicio') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>


    </div>
</div>
