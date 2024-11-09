<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        <h3 class="mb-4 text-xl font-semibold">{{ __('Información general') }}</h3>
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="mb-4 items-center sm:flex 2xl:flex sm:gap-4 2xl:gap-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <!-- Current Profile Photo -->
                <div x-show="! photoPreview">
                    @if ($this->user->profile_photo_path)
                        <img src="{{ Storage::url($this->user->profile_photo_path) }}" alt="{{ $this->user->name }}"
                            class="rounded-lg w-28 h-28">
                    @else
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                            class="rounded-lg w-28 h-28">
                    @endif

                </div>

                <!-- New Profile Photo Preview -->
                <div x-show="photoPreview" style="display: none;">
                    <span class="block rounded-lg w-28 h-28  bg-cover"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <div>
                    <h3 class="mb-1 text-xl font-bold text-gray-900">
                        {{ __('Foto de perfil') }}</h3>
                    <div class="mb-4 text-sm text-gray-500">
                        {{ __('JPG, JPEG o PNG. Tamaño máximo de 1MB') }}
                    </div>
                    <div class="flex items-center space-x-4">
                        <x-button type="button" x-on:click.prevent="$refs.photo.click()"
                            class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z">
                                </path>
                                <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                            </svg>
                            {{ __('Subir nueva foto') }}
                        </x-button>
                        @if ($this->user->profile_photo_path)
                            <x-button-danger type="button" wire:click="deleteProfilePhoto" class="">
                                {{ __('Eliminar foto') }}
                            </x-button-danger>
                        @endif

                        <x-input-error for="photo" class="mt-2" />
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-6 gap-4">
            <!-- Name -->
            <div class="col-span-6 sm:col-span-3">
                <x-label value="{{ __('Nombre de usuario') }}" />
                <x-input id="names" type="text" class="mt-1 block w-full" wire:model="state.names" required
                    autocomplete="names" />
                <x-input-error for="names" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-3">
                <x-label value="{{ __('Email') }}" />
                <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required
                    autocomplete="username" />
                <x-input-error for="email" class="mt-2" />

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                        !$this->user->hasVerifiedEmail())
                    <p class="text-sm mt-2 text-red-600">
                        {{ __('Tu correo electrónico no está verificado.') }}

                        <button type="button"
                            class="text-left underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            wire:click.prevent="sendEmailVerification">
                            {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                        </button>
                    </p>

                    @if ($this->verificationLinkSent)
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                        </p>
                    @endif
                @endif
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-label value="{{ __('Apodo') }}" />
                <input type="text" name="name" wire:model="state.name"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    placeholder="Nombres del Usuario" required="">
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-label value="{{ __('Apellido paterno') }}" />
                <input type="text" name="apellido_p" wire:model="state.apellido_p"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    placeholder="Apellido Paterno del Usuario" required="">
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-label value="{{ __('Apellido Materno') }}" />
                <input type="text" name="apellido_m" wire:model="state.apellido_m"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    placeholder="Apellido Materno del Usuario" required="">
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-label value="{{ __('DNI') }}" />
                <input type="text" name="dni" wire:model="state.dni"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    placeholder="DNI" required="">
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-label value="{{ __('Direccion') }}" />
                <input type="text" name="direccion" wire:model="state.direccion"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    placeholder="direccion" required="">
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-label value="{{ __('Telefono') }}" />
                <input type="text" name="telefono" wire:model="state.telefono"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    placeholder="telefono" required="">
            </div>

        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
        <x-action-message class="ms-3" on="saved">
            {{ __('Saved') }}
        </x-action-message>
    </x-slot>
</x-form-section>
