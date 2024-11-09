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
        <form method="POST"
            action="{{ route('aplication.editar', ['aplicationId' => $aplication->id]) }}"
            class="padre w-full max-w-lg py-4 px-4">
            @csrf
            @method('PUT')

            {{-- Seleccionar status --}}
            {{-- Seleccionar status --}}
            <div class="w-full md:w-12/12 px-3 mb-6 md:mb-0">
                <label for="status" class="">status*</label>
                <select name="status" id="status" required
                    class="appearance-none block w-full rounded-xl text-black border border-gray-400 py-2 px-2 mb-3 leading-tight focus:outline-none focus:bg-white">
                    <option value="" disabled selected>Selecciona un status</option>
                    <option value="PE" {{ $aplication->status == 'PE' ? 'selected' : '' }}>PENDIENTE</option>
                    <option value="AP" {{ $aplication->status == 'AP' ? 'selected' : '' }}>APROBA</option>
                    <option value="RE" {{ $aplication->status == 'RE' ? 'selected' : '' }}>RECHA</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
            </div>
            <div class="flex items-end justify-end  py-2 ">
                <button type="submit" class="ad m-2 bg-[#00B3FF] text-white px-4 py-2 rounded-md">
                    {{ isset($aplication) ? 'Guardar Cambios' : 'Guardar' }}
                </button>
                <a href="{{ route('registro-de-postulaciones.show', ['id' => $aplication->id]) }}"
                    class="m-2 text-[#00B3FF] px-4 py-2 rounded-md" style="border:solid orangered 0.5px">Cancelar</a>
            </div>
        </form>

    </x-slot>


</x-sidebar>
