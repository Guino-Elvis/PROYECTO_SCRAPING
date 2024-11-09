<x-guest-layout>

    <div class="contenedor">
        <div class="gradiante">
            <div class="cont-area-register-top rounded-b-lg">

                <div class="p-3 text-center flex justify-between">
                    <div class="flex justify-between">
                        <a href="/"
                            class="inline-flex items-center px-3 py-1 text-white rounded-lg font-normal text-xs  uppercase hover:text-gray-900 focus:outline-none active:text-white active:bg-gray-800 disabled:opacity-25 transition">
                            <i class="fa-solid fa-arrow-left mr-2"></i>
                            {{ trans('REGRESAR') }}
                        </a>
                        <div></div>
                    </div>
                </div>

            </div>
            <div class="xl:w-[100%] xl:h-[100%] 2xl:min-h-screen">
                <div class="login-wrap">
                    <div class="login-html">
                        <div class="w-full sm:py-6">
                            <div class="flex flex-col items-center justify-center px-1 mx-auto lg:py-0">
                                <div class="sombra w-full  rounded-xl  max-w-sm ">
                                    <div class="p-8 space-y-5 ">
                                        <div
                                            class="text-xl flex items-center before:mt-0.5 before:flex-1 before:border-t before:border-indigo-300 after:mt-0.5 after:flex-1 after:border-t after:border-indigo-300">
                                            <p class="mx-4 mb-0 text-center font-semibold text-indigo-700">
                                                {{ trans('¡Bienvenido!') }}
                                            </p>
                                        </div>
                                        <x-validation-errors />
                                        <div class="text-md font-normal md:text-base text-center text-gray-500">
                                            {{ trans('Por favor, ingrese con su cuenta') }}
                                        </div>
                                        <div class="login-form">
                                            <div class="sign-in-htm">
                                                <form class="flex flex-col gap-4" method="POST"
                                                    action="{{ route('iniciar_user') }}" autocomplete="off">
                                                    @csrf
                                                    <div class="group">
                                                        <label class="label" for="email"
                                                            value="{{ __('Email') }}">Correo
                                                            electrónico</label>
                                                        <input class="input" type="email" name="email"
                                                            id="email" placeholder="name@company.com" required>

                                                    </div>
                                                    <div class="group">
                                                        <div x-data="{ show: true }">
                                                            <label for="password" class="label">Contraseña</label>
                                                            <div class="relative">

                                                                <input id="password" type="password" name="password"
                                                                    required autocomplete="current-password"
                                                                    placeholder="••••••••"
                                                                    :type="show ? 'password' : 'text'" class="input">
                                                                <div
                                                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 cursor-pointer">
                                                                    <div class="h-5 text-gray-700 pt-0.5"
                                                                        @click="show = !show"
                                                                        :class="{ 'hidden': !show, 'block': show }">
                                                                        <i class="fa-solid fa-eye fa-lg"></i>
                                                                    </div>
                                                                    <div class="h-5 text-gray-700 pt-0.5"
                                                                        @click="show = !show"
                                                                        :class="{ 'block': !show, 'hidden': show }">
                                                                        <i class="fa-solid fa-eye-slash fa-lg"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="flex items-center justify-center gap-6">
                                                        <div class="flex items-start">
                                                            <button type="submit"
                                                                class=" px-8 py-2 text-white rounded-md text-sm bg-gradient-to-r from-indigo-700 to-blue-600 focus:ring-4 focus:outline-none focus:ring-indigo-300">

                                                                {{ trans('Iniciar sesion') }}
                                                            </button>
                                                        </div>

                                                    </div> --}}
                                                    <div class="group">
                                                        <button type="submit" class="button" style="cursor: pointer;" >
                                                            {{ trans('Iniciar sesion') }}
                                                       </button>
                                                    </div>
                                                    <a href="{{ route('password.request') }}"
                                                        class="text-xs sm:text-sm font-base text-7 hover:underline text-indigo-500 hover:text-indigo-600">
                                                        {{ trans('¿Olvidaste tu contraseña?') }}
                                                    </a>
                                                    <a href="{{ route('registrar-nuevo-usuario') }}"
                                                        class="text-xs sm:text-sm text-center font-base hover:underline text-indigo-500 hover:text-indigo-600">
                                                        {{ trans('¿Aún no tienes una cuenta?') }} <strong>
                                                            {{ trans('Registrate') }}</strong>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                        <style>
                                            .footer_google {
                                                text-align: center;
                                            }

                                            .login_line {
                                                width: 25%;
                                                height: 1px;
                                                background-color: #ccc;
                                                /* Color de la línea */
                                                margin: 10px 0;
                                                /* Espaciado superior e inferior de la línea */
                                            }

                                            .fg_content_01 {
                                                display: flex;
                                                justify-content: space-between;
                                                gap: 1rem;
                                                padding-bottom: 1rem;
                                            }
                                        </style>
                                        <div class="footer_google">
                                            <div class="fg_content_01">
                                                <div class="login_line"></div>
                                                <h1
                                                    class="text-xs sm:text-sm text-center font-base text-indigo-500 hover:text-indigo-600">
                                                    {{ trans('o inicie sesión con') }}
                                                </h1>
                                                <div class="login_line"></div>
                                            </div>

                                            @php
                                                $viewFromLR = session('fromLR');
                                                //dd($viewFromLR);
                                                // Verificar si existe una sesión llamada 'pago_session'
                                                if ($viewFromLR === 'login-register') {
                                                    session(['fromLRV' => 'login-register']);
                                                    session(['from' => 'login-bolsa']);
                                                    //dd(session('fromLRV'));
                                                } else {
                                                    session(['from' => 'login-bolsa']);
                                                }
                                            @endphp
                                            <div class="fg_content_02">
                                                <a href="{{ route('login-google') }}"
                                                    class="w-full text-sm bg-gradient-to-r from-indigo-700 to-blue-600
                                        focus:ring-4 focus:outline-none focus:ring-indigo-300
                                        hover:from-indigo-800 hover:to-blue-700
                                        inline-block px-4 py-2 rounded-md text-white">
                                                    <div class="flex justify-center items-center gap-2">
                                                        <img class="w-[1rem] h-[1rem]"
                                                            src="{{ asset('img/logo_google.png') }}"
                                                            class="fondo-login">
                                                        Google
                                                    </div>
                                                </a>
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
    </div>

    <style>
        .contenedor {
            position: relative;
            width: 100%;
            height: 100vh;
            background-image: url('https://www.shutterstock.com/image-photo/review-contract-report-business-woman-600nw-2197738025.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }

        .gradiante {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            background: rgba(40, 57, 101, 0.801);
        }

        .login-wrap {
            width: 100%;
            margin: auto;
            max-width: 25rem;
            min-height: 39rem;

            border-radius: 0.5rem;
            position: relative;
            background: url(https://thumbs.dreamstime.com/z/figuras-geom%C3%A9tricas-abstractas-en-fondo-azul-marino-tex-incons%C3%BAtil-56933301.jpg) no-repeat center;
            box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19);
        }

        .login-html {
            width: 100%;
            height: 100%;
            position: absolute;
            background: rgba(40, 57, 101, .9);
            border-radius: 0.5rem;

        }




        .login-html .sign-in,
        .login-html .sign-up,
        .login-form .group .check {
            display: none;
        }

        .login-html .tab,
        .login-form .group .label,
        .login-form .group .button {
            text-transform: uppercase;
        }

        .login-html .tab {
            font-size: 22px;
            margin-right: 15px;
            padding-bottom: 5px;
            margin: 0 15px 10px 0;
            display: inline-block;
            border-bottom: 2px solid transparent;
            color: rgb(91, 91, 233);
        }

        .login-html .sign-in:checked+.tab,
        .login-html .sign-up:checked+.tab {
            color: #fff;
            border-color: #1161ee;
        }

        .login-form {
            min-height: 250px;
            position: relative;
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        .login-form .group {
            margin-bottom: 10px;
        }

        .login-form .group .label,
        .login-form .group .input,
        .login-form .group .button {
            width: 100%;
            color: #fff;
            display: block;
        }

        .login-form .group .input,
        .login-form .group .button {
            border: none;
            padding: 10px 15px;
            border-radius: 25px;
            background: rgba(255, 255, 255, .1);
        }

        .login-form .group input[data-type="password"] {
            text-security: circle;
            -webkit-text-security: circle;
        }

        .login-form .group .label {
            color: #aaa;
            font-size: 12px;
        }

        .login-form .group .button {
            background: #1161ee;
        }

        .hr {
            height: 2px;
            margin: 25px 0 10px 0;
            background: rgba(255, 255, 255, .2);
        }

        .foot-lnk {
            color: rgba(255, 255, 255, 0.829);
            text-align: center;
        }
    </style>

</x-guest-layout>
