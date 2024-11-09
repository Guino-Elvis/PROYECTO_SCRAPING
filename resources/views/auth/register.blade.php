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
            <div class=" flex justify-center items-center">
                <div class="container px-auto pt-20 ">

                    <div class="login-wrap">
                        <div class="login-html px-10 py-10">
                            <div class="login-form">
                                <div class="sign-up-htm flex w-auto h-full">
                                    <x-validation-errors class="mb-4 bg-white rounded-xl px-5 py-5" />
                                    <form method="POST" action="{{ route('register_user') }}">
                                        @csrf
                                        <div class="flex flex-row gap-4">

                                            <div class="group">
                                                <label for="name" value="{{ __('Nombre de Usuario') }}"
                                                    class="label">Nombre de Usuario</label>
                                                <x-input id="name" class="input" type="text" name="name"
                                                    :value="old('name')" required autofocus autocomplete="name" />
                                            </div>
                                            <div class="group">
                                                <label for="names" value="{{ __('Nombre') }}"
                                                class="label">Nombres</label>
                                                <x-input id="names" class="input" type="text"
                                                    name="names" :value="old('names')" required autofocus
                                                    autocomplete="names" />
                                            </div>

                                        </div>
                                        <div class="flex flex-row gap-4">
                                            <div class="group">
                                                <label for="apellido_p" value="{{ __('Apellido Paterno') }}"
                                                    class="label">Apellido
                                                    Paterno</label>
                                                <x-input id="apellido_p" class="input" type="text"
                                                    name="apellido_p" :value="old('apellido_p')" required autofocus
                                                    autocomplete="apellido_p" />
                                            </div>
                                            <div class="group">
                                                <label for="apellido_m" value="{{ __('Apellido Materno') }}"
                                                    class="label">Apellido
                                                    Materno</label>
                                                <x-input id="apellido_m" class="input" type="text"
                                                    name="apellido_m" :value="old('apellido_m')" required autofocus
                                                    autocomplete="apellido_m" />
                                            </div>
                                        </div>

                                        <div class="group">
                                            <label for="direccion" value="{{ __('Direccion') }}"
                                                class="label">Direccion</label>
                                            <x-input id="direccion" class="input" type="text" name="direccion"
                                                :value="old('direccion')" required autocomplete="direccion" />
                                        </div>

                                        <div class="flex flex-row gap-4">
                                            <div class="group">
                                                <label for="dni" value="{{ __('DNI') }}"
                                                    class="label">DNI</label>
                                                <x-input id="dni" class="input" type="text" name="dni"
                                                    :value="old('dni')" required autocomplete="dni" />
                                            </div>
                                            <div class="group">
                                                <label for="telefono" value="{{ __('Telefono') }}"
                                                    class="label">Telefono</label>
                                                <x-input id="telefono" class="input" type="text"
                                                    name="telefono" :value="old('telefono')" required
                                                    autocomplete="telefono" />
                                            </div>
                                        </div>
                                        <div class="group">
                                            <label for="email" value="{{ __('Email') }}"
                                                class="label">Email</label>
                                            <x-input id="email" class="input" type="email" name="email"
                                                :value="old('email')" required autocomplete="username" />
                                        </div>
                                        <div class="group">
                                            <label for="password" value="{{ __('Password') }}"
                                                class="label">Password</label>
                                            <x-input id="password" class="input" type="password" name="password"
                                                required autocomplete="new-password" />
                                        </div>
                                        <div class="group">
                                            <label for="password_confirmation" value="{{ __('Confirm Password') }}"
                                                class="label">Confirm Password</label>
                                            <x-input id="password_confirmation" class="input" type="password"
                                                name="password_confirmation" required autocomplete="new-password" />
                                        </div>
                                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                            <div class="mt-4">
                                                <x-label for="terms">
                                                    <div class="flex items-center">
                                                        <x-checkbox class="cursor-pointer" name="terms"
                                                            id="terms" required />
                                                        <div class="ml-2">
                                                            Acepto los
                                                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                                href="{{ route('terms.show') }}">Términos de servicio</a>


                                                        </div>
                                                    </div>
                                                </x-label>
                                            </div>
                                        @endif


                                        <div class="group">
                                            <input type="submit" class="button" value="Registrar"
                                                style="cursor: pointer;">
                                        </div>

                                        <div class="hr"></div>
                                        <div class="foot-lnk">
                                            @php
                                                $viewFromLR = session('fromLR');

                                                if ($viewFromLR === 'login-register') {
                                                    session(['fromLRV' => 'login-register']);
                                                    session(['from' => 'registrar-nuevo-usuario']);
                                                    //dd(session('fromLRV'));
                                                } else {
                                                    session(['from' => 'registrar-nuevo-usuario']);
                                                }
                                            @endphp
                                            <div>O Registrate con</div>
                                            <div class="pt-2" >
                                                <a href="{{ route('login-google') }}"
                                                    class="w-full text-sm bg-gradient-to-r from-indigo-700 to-blue-600
                                                        focus:ring-4 focus:outline-none focus:ring-indigo-300
                                                        hover:from-indigo-800 hover:to-blue-700
                                                        inline-block px-4 py-2 rounded-md text-white">
                                                    <div class="flex justify-center items-center gap-2">
                                                        <img class="w-[1rem] h-[1rem]"
                                                            src="{{ asset('img/logo_google.png') }}" class="fondo-login">
                                                        Google
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>




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
        min-height: 47rem;
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
