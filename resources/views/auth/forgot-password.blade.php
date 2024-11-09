<x-guest-layout>

    <style>
        .sombra {
            box-shadow: 0px 0px 30px 5px rgb(153, 153, 153);
        }

        .fondo-login {
            position: fixed;
            z-index: -1;
            width: 100%;
            height: 100%;
        }

        .cont-area {
            position: absolute;
            background-color: rgb(255 255 255 / 0.8);
            width: 100%;
        }

        .input-login {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity));
            border-width: 1px;
            --tw-border-opacity: 1;
            border-color: rgb(209 213 219 / var(--tw-border-opacity));
            border-radius: 0.5rem
                /* 8px */
            ;
            width: 100%;
            padding: 0.625rem
                /* 10px */
            ;
            padding-left: 2.5rem
                /* 40px */
            ;
        }

        .btn-ingresar {
            border-radius: 0.5rem
                /* 8px */
            ;
            color: rgb(255 255 255 / 1);
            font-weight: 500;
            padding-bottom: 0.625rem
                /* 10px */
            ;
            padding-left: 2.5rem
                /* 40px */
            ;
            padding-right: 1.25rem
                /* 20px */
            ;
            padding-top: 0.625rem
                /* 10px */
            ;
            position: relative;
            text-align: center;
            width: 100%;
        }
    </style>

    <img src="img/fondo-login.png" class="fondo-login">

    <div class="flex items-center h-screen">
        <div class="cont-area top-0 rounded-b-lg">
            <div class="flex gap-2">
                <div class="flex-1 bg-green-600 h-1 rounded-md"></div>
                <div class="flex-1 bg-blue-600 h-1 rounded-md"></div>
                <div class="flex-1 bg-yellow-500 h-1 rounded-md"></div>
                <div class="flex-1 bg-red-600 h-1 rounded-md"></div>
                <div class="flex-1 bg-gray-700 h-1 rounded-md"></div>
            </div>
            a<div class="p-3 text-center">
                <div class="flex justify-between">
                    <a href="{{ route('login-bolsa') }}"
                        class="inline-flex items-center px-3 py-1 bg-white rounded-lg font-normal text-xs text-gray-700 uppercase hover:text-gray-900 focus:outline-none active:text-white active:bg-gray-800 disabled:opacity-25 transition">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        Regresar
                    </a>
                    <div></div>
                </div>
            </div>
        </div>
        <div class="cont-area bottom-0 rounded-t-lg">
            <div class="py-3 text-center text-gray-500 text-sm">
                © 2022 BOLSALABORAL. Todos los derechos reservados
            </div>
            <div class="flex gap-2">
                <div class="flex-1 bg-green-600 h-1 rounded-md"></div>
                <div class="flex-1 bg-blue-600 h-1 rounded-md"></div>
                <div class="flex-1 bg-yellow-500 h-1 rounded-md"></div>
                <div class="flex-1 bg-red-600 h-1 rounded-md"></div>
                <div class="flex-1 bg-gray-700 h-1 rounded-md"></div>
            </div>
        </div>
        <div class="w-full">
            <div class="flex items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <div class="sombra w-full bg-white rounded-xl border max-w-md border-gray-300">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <span class="flex items-center justify-center text-lg font-semibold text-gray-900">
                            <img class="w-40 mr-2" src="img/infotel.png" alt="logo">
                        </span>
                        <div class="text-xs font-normal md:text-sm text-center">
                            ¿Olvidaste tu contraseña? No hay problema. Simplemente háganos saber su dirección de correo
                            electrónico y le enviaremos un enlace de restablecimiento de contraseña que le permitirá
                            elegir una nueva.
                        </div>
                        <x-validation-errors class="mb-4" />
                        <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('password.email') }}"
                            autocomplete="off">
                            @csrf
                            <div class="">
                                <label for="email" class="block mb-2 text-sm font-normal">
                                    Correo electrónico
                                </label>
                                <label class="relative">
                                    <input type="email" name="email" id="email"
                                        class="input-login text-xs sm:text-sm placeholder-gray-400 focus:ring-indigo-600 focus:border-indigo-600"
                                        placeholder="name@company.com" required="">
                                    <div class="absolute inset-y-0 left-0 pl-3 pt-1.5 flex items-center text-sm leading-5">
                                        <i class="fa-regular fa-envelope fa-lg"></i>
                                    </div>
                                </label>
                            </div>
                            <div class="">
                                <button type="submit"
                                    class="btn-ingresar text-sm bg-gradient-to-r from-indigo-700 to-blue-600 focus:ring-4 focus:outline-none focus:ring-green-300">
                                    <span class="absolute left-0 inset-y-0 flex items-center pl-3 pt-1">
                                        <i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i>
                                    </span>
                                    Enviar enlace
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
