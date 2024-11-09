@section('title', __('Configurar cuenta - Perfil'))
@section('header', __('Configurar cuenta'))
@section('section', __('Perfil'))

<div>
    <div class="grid grid-cols-1 xl:grid-cols-3 xl:gap-4">

        <div class="col-span-2">

            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg">
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    @livewire('profile.update-profile-information-form')
                @endif
            </div>

            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg">
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    @livewire('profile.update-password-form')
                @endif
            </div>

        </div>

        <div class="col-span-full xl:col-auto">
            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg 2xl:col-span-2">
                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    @livewire('profile.two-factor-authentication-form')
                @endif
            </div>

            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg 2xl:col-span-2">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

        </div>
    </div>
</div>
