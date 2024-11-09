<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Include Styles -->
    @include('layouts/sections/styles')

    @include('layouts/sections/scripts')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
    </style>
</head>

<body>
    <div class="min-h-screen w-screen bg-gray-50 flex items-center justify-center">
        <div class="container md:flex items-center justify-between px-5 text-gray-700">
            <div class="w-full lg:w-1/2 mx-8">
                <div class="text-7xl text-green-500 font-dark font-extrabold mb-8"> Error @yield('code')</div>
                <p class="text-2xl md:text-3xl font-light leading-normal mb-8">
                    @yield('message')
                </p>

                <a href="/"
                    class="px-5 inline py-3 text-sm font-medium leading-5 shadow-2xl text-white transition-all duration-400 border border-transparent rounded-lg focus:outline-none bg-green-600 active:bg-green-600 hover:bg-green-700">
                    Volver a la página de inicio
                </a>
            </div>
            <div class="w-full lg:flex lg:justify-end lg:w-1/2 mx-5 my-12">
                <img src="https://user-images.githubusercontent.com/43953425/166269493-acd08ccb-4df3-4474-95c7-ad1034d3c070.svg"
                    class="" alt="Page not found">
            </div>

        </div>
    </div>
</body>

</html>
