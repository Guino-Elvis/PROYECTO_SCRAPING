<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/img/icono.png" type="image/png">
    <link rel="shortcut icon" href="/img/icono.png">

    <title>BOLSALABORAL - Ofertas Laborales</title>

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

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

    {{-- notificaciones push --}}
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="font-sans antialiased" x-data="{ sidebarVisible: false }">

    <x-banner />

    <div class="min-h-screen " style="background: #F0F2F5">

        @php
            $route = Route::getRoutes()->getByAction(request()->route()->getActionName());
        @endphp

        @if (Auth::user() && $route && in_array('auth:sanctum', $route->gatherMiddleware()))
            <x-sidebar>
                <x-slot name="content">
                    <div>
                        {{ $slot }}
                    </div>
                </x-slot>
            </x-sidebar>
        @else
            @livewire('navigation')
            <main>
                {{ $slot }}

            </main>
        @endif

    </div>

    @stack('modals')

    @livewireScripts

    @stack('js')

    <script type="text/javascript">
        Livewire.on('alert', function(message) {
            Swal.fire({
                title: 'Mensaje del sistema',
                text: message,
                icon: 'success',
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'swal-button-green'
                }
            });
        });
        AOS.init();
    </script>
    <style>
        /* Estilo personalizado para el botón de confirmación */
        .swal-button-green {
            background-color: #40bb5d !important;
            /* Verde */
            color: white;
            border: none;
        }

        .swal-button-green:hover {
            background-color: #218838 !important;
            /* Verde oscuro */
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>


</body>

</html>
