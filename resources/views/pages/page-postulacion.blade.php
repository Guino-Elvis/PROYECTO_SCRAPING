<div class="flex flex-col bg-white">

    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            <div class="flex flex-col gap-2 bg-white px-5 py-5 rounded-lg shadow-md shadow-gray-400">
                <div class="w-11/12 lg:w-2/6 mx-[auto] pb-5">
                    <div class="bg-gray-200 h-1 flex items-center justify-between">
                        <div class="w-2/3 bg-indigo-700 h-1 flex items-center">
                            <div class="bg-indigo-700 h-6 w-6 rounded-full shadow flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="18"
                                    height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path d="M5 12l5 5l10 -10" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-2/3 flex justify-between h-1 items-center relative">

                            <div class="bg-white h-6 w-6 rounded-full shadow flex items-center justify-center -mr-3 relative">
                                <div class="h-3 w-3 animate-pulse bg-indigo-700 rounded-full"></div>
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


                    <div class="bg-white px-2 py-2 rounded-lg shadow-md shadow-gray-400">
                        <div class="text-gray-600  rounded-lg p-2 flex flex-row gap-4">
                            <span class="text-black font-bold">Nombre : </span>
                            <div>
                                {{$postulante->name }}{{$postulante->paterno }}{{$postulante->materno }}
                            </div>
                        </div>
                        <div class="text-gray-600  rounded-lg p-2 flex flex-row gap-4">
                            <span class="text-black font-bold">Documento de identidad : </span>
                            <div>
                                {{$postulante->document }}
                            </div>
                        </div>
                        <div class="text-gray-600  rounded-lg p-2 flex flex-row gap-4">
                            <span class="text-black font-bold">Telefono : </span>
                            <div>
                                {{$postulante->phone }}
                            </div>
                        </div>

                        <div class="text-gray-600  rounded-lg p-2 flex flex-row gap-4">
                            <span class="text-black font-bold">Correo Electronico : </span>
                            <div>
                                {{$postulante->email }}
                            </div>
                        </div>

                    </div>

                    <form action="{{ route('grabar.postulacion_result') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                            <div class="w-full md:w-6/12 px-3 mb-6 md:mb-0">
                                <label >
                                    documento
                                </label>
                                <input type="file" name="documentos" accept=".pdf, .doc, .docx, .txt"  required>
                            </div>
                            <!-- Agrega un identificador al input para que podamos seleccionarlo fácilmente -->
                            <input id="fecha_postulacion" name="fecha_postulacion" type="hidden">
                            <input type="hidden" name="oferta_laboral_id" value="{{ $detalles->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <div class="flex items-end justify-end  gap-5 px-10 py-10">
                                <button type="submit" class="rounded-full text-blue-400 border-2 border-blue-400 font-bold px-8 py-1.5  hover:text-white  hover:bg-blue-400">
                                    Guardar
                                </button>
                                <a href="/"class="rounded-full bg-blue-400 text-white font-bold px-8 py-2 hover:bg-transparent hover:text-blue-400 hover:border-2 hover:border-blue-400">Cancelar</a>

                            </div>
                    </form>
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

<script>
    // Obtener la fecha actual
    var fechaActual = new Date();

    // Obtener el día, mes y año de la fecha actual
    var dia = fechaActual.getDate();
    var mes = fechaActual.getMonth() + 1; // Los meses en JavaScript son indexados desde 0, por lo que se suma 1 al mes
    var anio = fechaActual.getFullYear();

    // Formatear el día y mes para que tengan dos dígitos si es necesario
    if (dia < 10) {
        dia = '0' + dia;
    }
    if (mes < 10) {
        mes = '0' + mes;
    }

    // Crear una cadena de texto con la fecha actual en el formato "YYYY-MM-DD"
    var fechaHoy = anio + '-' + mes + '-' + dia;

    // Establecer la fecha actual como el valor predeterminado del campo de entrada de fecha
    document.getElementById("fecha_postulacion").value = fechaHoy;
    </script>
