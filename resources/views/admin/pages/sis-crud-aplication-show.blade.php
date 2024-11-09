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
        @section('section', 'BOLSALABORAL/Show')
        <div class="flex  items-center justify-start">
            <a href="{{ route('oferta-laboral.show', ['id' => $aplicationdetail->oferta_laboral->id]) }}"
                class="flex flex-row items-center justify-start uppercase font-bold  gap-4 py-1 px-4 hover:bg-gray-500 hover:text-white hover:rounded-lg">
                <i class="fa-solid fa-reply-all"></i>
                <div>Regresar</div>
            </a>
        </div>


        <!-- Page Content -->
        <div class="shadow-lg border-b border-gray-200 rounded-lg ">

            <table class="w-full table-auto">
                <tbody class="divide-y divide-gray-300 bg-white">
                    <tr class="text-sm font-medium text-gray-900 hover:bg-gray-100">
                        <td class=" px-6 py-4 text-start ">
                            <div class="flex justify-start items-center bg-blue-400 py-2 px-2 rounded-xl text-white">
                                <div class="uppercase">
                                    Numero de postulacion : {{ $aplicationdetail->numero }}
                                </div>
                            </div>
                            <div class="flex  flex-row justify-between w-full flex-wrap">
                                <div
                                    class="w-2/3 flex justify-centert items-center bg-white shadow-md shadow-gray-300 rounded-xl py-1 px-10 mt-2">
                                    <div class="uppercase">
                                        Nombre del postulante : {{ $aplicationdetail->postulante->name }}
                                        {{ $aplicationdetail->postulante->paterno }}
                                        {{ $aplicationdetail->postulante->materno }}
                                    </div>

                                </div>
                                <div
                                    class="1/3 flex justify-center items-center bg-white shadow-md shadow-gray-300 rounded-xl py-1 px-10 mt-2">
                                    <div class="uppercase">
                                        Fecha de postulacion : {{ $aplicationdetail->fecha_postulacion }}

                                    </div>

                                </div>
                            </div>
                            <div class="flex flex-row gap-4 justify-start items-center py-1 flex-wrap">


                                <div class="bg-white shadow-md shadow-gray-300 rounded-xl py-1 px-10">
                                    <div class="flex flex-row gap-2">
                                        <div class="font-extrabold text-black uppercase">Correo :
                                        </div>
                                        <div class="flex justify-start items-start">
                                            {{ $aplicationdetail->postulante->email }}
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white shadow-md shadow-gray-300 rounded-xl py-1 px-10">
                                    <div class="flex flex-row gap-2">
                                        <div class="font-extrabold text-black uppercase">Direccion :
                                        </div>
                                        <div class="flex justify-start items-start">
                                            {{ $aplicationdetail->postulante->address }}
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white shadow-md shadow-gray-300 rounded-xl py-1 px-10">
                                    <div class="flex flex-row gap-2">
                                        <div class="font-extrabold text-black uppercase">Numero de celular :
                                        </div>
                                        <div class="flex justify-start items-start">
                                            {{ $aplicationdetail->postulante->phone }}
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white shadow-md shadow-gray-300 rounded-xl py-1 px-10">
                                    <div class="flex flex-row gap-2">
                                        <div class="font-extrabold text-black uppercase">DNI :
                                        </div>
                                        <div class="flex justify-start items-start">
                                            {{ $aplicationdetail->postulante->document }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="flex justify-between items-center pt-10">
                                <div class="flex flex-row gap-4 justify-center items-center">
                                    <div class="bg-white shadow-md shadow-gray-300 rounded-xl py-1 px-10 ">
                                        <div class="flex flex-row gap-4">
                                            <div class="font-extrabold text-black uppercase">Estado :</div>
                                            <div class="flex justify-start items-start">
                                                @if ($aplicationdetail->status == 'PE')
                                                    <span
                                                        class="bg-amber-100 text-amber-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                        PENDIENTE
                                                    </span>
                                                @elseif ($aplicationdetail->status == 'AP')
                                                    <span
                                                        class="bg-green-100 text-green-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                        APROBADO
                                                    </span>
                                                @elseif ($aplicationdetail->status == 'RE')
                                                    <span
                                                        class="bg-red-500 text-white text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                        RECHAZADO
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    @php
                                        $user = Auth::user();
                                        $userRoleName = $user->roles->first()->name;
                                    @endphp
                                    @if ($userRoleName === 'Administrador' || $userRoleName === 'Empresa')
                                        <a href="{{ route('aplication.editar', ['aplicationId' => $aplicationdetail->id]) }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                    @else
                                        <samp></samp>
                                    @endif
                                    {{-- <a href="{{ route('aplication.editar', ['aplicationId' => $aplicationdetail->id]) }}"> <i class="fa-regular fa-pen-to-square"></i></a> --}}
                                </div>
                                <div class="flex gap-2">
                                    <div class="font-extrabold text-black uppercase">Nombre de la OFERTA LABORAL:
                                    </div>
                                    <div class="flex justify-start items-start">
                                        {{ $aplicationdetail->oferta_laboral->titulo }}</div>
                                </div>
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
                                <div class="font-extrabold text-black uppercase">CV DEL POSTULANTE
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="shadow-lg border-b border-gray-200 rounded-lg overflow-auto my-5">
            <div class="flex flex-col px-6 py-4">
                <div class="flex flex-row  bg-white shadow-md shadow-gray-300 rounded-xl py-1 px-10">
                    <div class="flex flex-row border rounded-lg ">
                        <div class="bg-gray-200 px-1 pt-1 py-3 rounded-l-lg">
                            <img src="/img/pdf-logo.png" alt="">
                        </div>
                        <div class="flex justify-center items-start flex-col px-4">
                            <div>
                                {{ strlen($aplicationdetail->documentos) > 30 ? substr($aplicationdetail->documentos, 0, 30) . '...' : $aplicationdetail->documentos }}
                            </div>
                            <div class="flex flex-row gap-5">
                                <div>
                                    <a href="#" class=" text-gray-600 text-sm hover:text-blue-400 "
                                        id="visualizarDocumento">Visualizar</a>
                                </div>
                                <div>
                                    <!-- Enlace para descargar el documento -->
                                    <a href="{{ asset('storage/' . $aplicationdetail->documentos) }}"
                                        class=" text-gray-600 text-sm hover:text-blue-400 "
                                        download="{{ $aplicationdetail->postulante->name }} {{ $aplicationdetail->postulante->paterno }} {{ $aplicationdetail->postulante->materno }}/{{ $aplicationdetail->id }}">
                                        Descargar Archivo
                                    </a>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="modalDocumento" class="fixed top-0 left-0 w-full h-full  z-50 hidden">
                <div class="flex items-center justify-center">
                    <div class="absolute w-full h-full bg-gray-500 opacity-75" id="modalBackground"></div>
                    <div class="modal-dialog flex items-center justify-center z-50">
                        <div class="modal-content bg-white  p-4 rounded-lg overflow-hidden">
                            <div class="modal-header flex justify-between items-center border-b border-gray-200">
                                <h5 class="modal-title">Vista previa del documento</h5>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cerrar</button>
                            </div>
                            <div class="modal-body overflow-auto max-h-96">
                                <div id="viewer" style="height: auto;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
            <script>
                // Agregar un evento click al enlace "Visualizar"
                document.getElementById('visualizarDocumento').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevenir el comportamiento predeterminado del enlace

                    // URL del documento
                    var url = "{{ asset('storage/' . $aplicationdetail->documentos) }}";

                    // Cargar el documento PDF
                    pdfjsLib.getDocument(url).promise.then(function(pdf) {
                        var totalPages = pdf.numPages; // Obtener el número total de páginas del documento

                        // Limpiar el contenido existente en el visor
                        var viewer = document.getElementById('viewer');
                        viewer.innerHTML = '';

                        // Renderizar todas las páginas del PDF
                        for (var pageNumber = 1; pageNumber <= totalPages; pageNumber++) {
                            pdf.getPage(pageNumber).then(function(page) {
                                // Configurar el visor
                                var scale = 1.5;
                                var viewport = page.getViewport({
                                    scale: scale
                                });

                                // Preparar el lienzo para mostrar la página
                                var canvas = document.createElement('canvas');
                                var context = canvas.getContext('2d');
                                canvas.height = viewport.height;
                                canvas.width = viewport.width;

                                // Renderizar la página en el lienzo
                                var renderContext = {
                                    canvasContext: context,
                                    viewport: viewport
                                };
                                page.render(renderContext);

                                // Mostrar el lienzo en el modal
                                viewer.appendChild(canvas);
                            }).catch(function(error) {
                                console.error('Error al renderizar la página:', error);
                                // Manejar errores, como mostrar un mensaje al usuario
                            });
                        }

                        // Mostrar el modal después de cargar el documento con éxito
                        document.getElementById('modalDocumento').classList.remove('hidden');
                    }).catch(function(error) {
                        console.error('Error al cargar el documento PDF:', error);
                        // Manejar errores, como mostrar un mensaje al usuario
                    });
                });

                // Agregar evento clic al botón de cierre del modal
                document.querySelector('[data-bs-dismiss="modal"]').addEventListener('click', function() {
                    document.getElementById('modalDocumento').classList.add('hidden');
                });

                // Agregar evento clic al fondo oscuro para cerrar el modal
                document.getElementById('modalBackground').addEventListener('click', function() {
                    document.getElementById('modalDocumento').classList.add('hidden');
                });
            </script>
            <style>
                .modal-dialog {
                    width: 90%;
                    /* Ajusta el ancho del modal según sea necesario */
                    max-width: 60rem;
                    /* Establece un ancho máximo para el modal */
                }

                .modal-body {
                    max-height: calc(100vh - 200px);
                    /* Establece la altura máxima del cuerpo del modal */
                }
            </style>
    </x-slot>


</x-sidebar>
