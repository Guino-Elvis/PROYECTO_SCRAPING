<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Antes de continuar, ¿Podría verificar su dirección de correo electrónico haciendo click en el enlace que le acabamos de enviar por correo electrónico? Si no recibió el correo electrónico, con gusto le enviaremos otro.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Se envió un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó en la configuración de su perfil.') }}
            </div>
        @endif

        <div class="mt-4" style="display: grid; width: min-content; grid-template-columns: repeat(2, 90% 100px);">
            <form method="GET" action="{{ route('verificacion.resend') }}">
                @csrf

                <div>
                    <x-button type="submit">
                        {{ __('Reenviar correo electrónico de verificación') }}
                    </x-button>
                </div>
            </form>

            <div style="
                display: grid;
                align-items: center;
                justify-content: center;
                text-align: center;
            ">
                <a
                    href="{{ route('profile.show') }}"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    {{ __('Editar Perfil') }}</a>

                <form method="POST" action="{{ route('cerrar-sesion') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-2">
                        {{ trans('menuvertical.Cerrar sesión') }}
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
