<div class="flex flex-col bg-white ">



    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            <div class="flex flex-col gap-2">
                <div class="bg-white px-4 py-8 shadow-md shadow-gray-400">
                    <div class="w-11/12 lg:w-2/6 mx-[auto] pb-5 ">
                        <div class="bg-gray-200 h-1 flex items-center justify-between">
                            <div class="w-1/3  h-1 flex items-center">
                                <div
                                    class="bg-white h-6 w-6 rounded-full  shadow flex items-center justify-center -mr-3 relative">
                                    <div class="h-3 w-3 animate-pulse  bg-indigo-700 rounded-full"></div>
                                </div>
                            </div>
                            <div class="w-1/3 flex justify-between  h-1 items-center relative">

                                <div class="w-2/3 flex justify-end">
                                    <div class="bg-white h-6 w-6 rounded-full shadow"></div>
                                </div>
                            </div>
                            <div class="w-1/3 flex justify-end">
                                <div class="bg-white h-6 w-6 rounded-full shadow"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-center items-center">
                            <span class="py-5 text-center text-xl font-bold">Datos del postulante</span>
                        </div>

                        <form autocomplete="off">
                            <div class="flex flex-col gap-2.5 w-full px-2">
                                <div class="flex flex-col gap-2.5 w-full">
                                    <div class="mb-1">
                                        <x-label value="Nombre Completo" class="font-bold" />
                                        <x-input class="w-full" type="text" wire:model="postulante.name" />
                                        @unless (!empty($postulante['name']))
                                            <x-input-error for="postulante.name" />
                                        @endunless
                                    </div>
                                    <div class="mb-1">
                                        <x-label value="Apellido Paterno" class="font-bold" />
                                        <x-input class="w-full" type="text" wire:model="postulante.paterno" />
                                        @unless (!empty($postulante['paterno']))
                                            <x-input-error for="postulante.paterno" />
                                        @endunless
                                    </div>
                                    <div class="mb-1">
                                        <x-label value="Apellido Materno" class="font-bold" />
                                        <x-input class="w-full" type="text" wire:model="postulante.materno" />
                                        @unless (!empty($postulante['materno']))
                                            <x-input-error for="postulante.materno" />
                                        @endunless
                                    </div>

                                    <div class="mb-1">
                                        <x-label value="Direccion" class="font-bold" />
                                        <x-input class="w-full" type="text" wire:model="postulante.address" />
                                        @unless (!empty($postulante['address']))
                                            <x-input-error for="postulante.address" />
                                        @endunless
                                    </div>

                                    <div class="mb-1">
                                        <x-label value="Email" class="font-bold" />
                                        <x-input class="w-full" type="email" wire:model="postulante.email" />
                                        @unless (!empty($postulante['email']))
                                            <x-input-error for="postulante.email" />
                                        @endunless
                                    </div>

                                    <div class="mb-1">
                                        <x-label value="Documento de Identidad" class="font-bold" />
                                        <x-input class="w-full" type="number" wire:model="postulante.document" />
                                        @unless (!empty($postulante['document']))
                                            <x-input-error for="postulante.document" />
                                        @endunless
                                    </div>
                                    <div class="mb-1">
                                        <x-label value="Telefono(Celular)" class="font-bold" />
                                        <x-input class="w-full" type="number" wire:model="postulante.phone" />
                                        @unless (!empty($postulante['phone']))
                                            <x-input-error for="postulante.phone" />
                                        @endunless
                                    </div>
                                    <div class="mb-1">
                                        <x-label value="Acepto el tratamiento de datos personales" class="font-bold" />
                                        <x-input type="checkbox" wire:model="postulante.tdatos" value="1" />
                                        @unless (!empty($postulante['tdatos']))
                                            <x-input-error for="postulante.tdatos" />
                                        @endunless
                                    </div>
                                </div>
                            </div>
                        </form>
                        <x-button-success wire:click.prevent="store()" class="disabled:opacity-25">
                            Crear
                        </x-button-success>

                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="sticky top-24 z-50">
                    <div
                        class="flex flex-col scale-100 bg-white border-2 from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div class="p-6 w-auto h-auto flex flex-col shadow-md shadow-gray-300">
                            <h2 class="mt-6 text-xl font-semibold text-gray-900">{{ $detalles->titulo }}</h2>

                            <div class="flex fle-row justify-start items-center pt-2 gap-2">
                                <span
                                    class="flex justify-start items-center text-sm ">{{ $detalles->empresa->ra_social }}</span>
                                <div class="flex justify-center items-center">
                                    <span class="border-e h-5  border-gray-400"></span>
                                </div>
                                <span class="flex justify-start items-center text-sm ">{{ $detalles->ubicacion }}
                                </span>
                                <div class="flex justify-center items-center">
                                    <span class="border-e h-5  border-gray-400"></span>
                                </div>
                                <span class="flex justify-start items-center text-sm ">{{ $detalles->remuneracion }}
                                </span>
                            </div>
                        </div>
                        <div class="max-h-[34rem] overflow-y-auto" id="scrollableDiv">
                            <div class="p-6 w-auto h-auto flex flex-col border-b border-gray-400">
                                <h2 class="mt-6 text-xl font-semibold text-gray-900">Informacion del empleo</h2>
                                <h6 class="text-xs font-bold text-gray-400">Así es como las especificaciones del empleo
                                    se
                                    alinean con tu perfil</h6>
                                <div class="flex fle-row justify-start items-center pt-2 gap-2">
                                    <span
                                        class="flex justify-start items-center text-sm ">{{ $detalles->empresa->ra_social }}</span>
                                    <div class="flex justify-center items-center">
                                        <span class="border-e h-5  border-gray-400"></span>
                                    </div>
                                    <span class="flex justify-start items-center text-sm ">{{ $detalles->ubicacion }}
                                    </span>
                                </div>
                                <div class="flex flex-col gap-6">
                                    <div class="flex flex-row gap-4">
                                        <samp class="flex justify-start items-start"><i
                                                class="fa-solid fa-circle-dollar-to-slot"></i></samp>
                                        <div class="flex flex-col gap-2 font-bold ">
                                            <h2
                                                class=" text-md font-semibold text-gray-900 justify-start items-center flex">
                                                Sueldo</h2>
                                            <span
                                                class="flex justify-start items-center text-sm bg-gray-200 rounded-md py-1 px-2">{{ $detalles->remuneracion }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-row gap-4">
                                        <samp class="flex justify-start items-start"><i
                                                class="fa-solid fa-suitcase"></i></samp>
                                        <div class="flex flex-col gap-2 font-bold ">
                                            <h2
                                                class=" text-md font-semibold text-gray-900 justify-start items-center flex">
                                                Tipo de empleo</h2>
                                            <span
                                                class="flex justify-start items-center text-sm bg-gray-200 rounded-md py-1 px-2">Tiempo
                                                completo</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 w-auto h-auto flex flex-col">
                                <div class="flex flex-col">
                                    <h2 class="mt-6 text-xl font-semibold text-gray-900">Ubicacion</h2>

                                    <div class="flex fle-row justify-start items-center pt-2 gap-2">
                                        <span
                                            class="flex justify-start items-center text-sm ">{{ $detalles->ubicacion }}</span>
                                    </div>
                                </div>
                                <samp class="border-b border-gray-400 py-2"></samp>
                                <div class="flex flex-col">
                                    <h2 class="mt-6 text-xl font-semibold text-gray-900">Descripción completa del
                                        empleo
                                    </h2>

                                    <div class="flex fle-row justify-start items-center pt-2 gap-2">
                                        <p>
                                            {{ $detalles->body }}
                                        </p>
                                    </div>
                                </div>
                                <samp class="border-b border-gray-400 py-2"></samp>
                                <div class="flex flex-col">

                                    <div class="flex fle-row justify-start items-center pt-2 gap-2">
                                        <span
                                            class="gap-2 flex justify-start items-center text-sm bg-gray-300 rounded-md text-black py-2 px-6 font-bold flex-row">
                                            <samp><i class="fa-solid fa-flag"></i></samp>
                                            <h1>Reportar empleo</h1>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
