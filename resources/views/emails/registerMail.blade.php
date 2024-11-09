@component('mail::message')
    <p> <strong>¡Hello!</strong> {{ $user->name }}</p>
    <p> Haga clic en el botón a continuación para verificar su dirección de correo electrónico. </p>
    @component('mail::button', ['url' => url('/email/verify/' . $user->remember_token)])
        {{ __('Verificar Correo') }}
    @endcomponent
    <p>En caso de que tenga problemas, comuníquese con nuestro contacto.</p>
    Gracias,<br>
    {{ config('app.name') }}
@endcomponent
