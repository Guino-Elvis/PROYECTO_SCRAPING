<x-form-section submit="updatePassword">

    <x-slot name="title">
        <h3 class="mb-4 text-xl font-semibold">{{ __('Información de contraseña') }}</h3>
    </x-slot>

    <x-slot name="form">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-6 sm:col-span-3">
                <x-label for="current_password" value="{{ __('Contraseña actual') }}" />
                <x-input id="current_password" type="password" placeholder="••••••••" class="mt-1 block w-full"
                    wire:model="state.current_password" autocomplete="current-password" />
                <x-input-error for="current_password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-label for="password" value="{{ __('Nueva contraseña') }}" />
                <input data-popover-target="popover-password" data-popover-placement="bottom" type="password"
                    id="password" wire:model="state.password" autocomplete="new-password"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    placeholder="••••••••" required="">
                <div data-popover="" id="popover-password" role="tooltip"
                    class="absolute z-10 inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm w-72 opacity-0 invisible"
                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(520px, -1768px);"
                    data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top">
                    <div class="p-3 space-y-2">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Must have at least 6 characters</h3>
                        <div class="grid grid-cols-4 gap-2">
                            <div class="h-1 bg-orange-300 dark:bg-orange-400"></div>
                            <div class="h-1 bg-orange-300 dark:bg-orange-400"></div>
                            <div class="h-1 bg-gray-200 dark:bg-gray-600"></div>
                            <div class="h-1 bg-gray-200 dark:bg-gray-600"></div>
                        </div>
                        <p>It’s better to have:</p>
                        <ul>
                            <li class="flex items-center mb-1">
                                <svg class="w-4 h-4 mr-2 text-green-400 dark:text-green-500" aria-hidden="true"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Upper &amp; lower case letters
                            </li>
                            <li class="flex items-center mb-1">
                                <svg class="w-4 h-4 mr-2 text-gray-300 dark:text-gray-400" aria-hidden="true"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                A symbol (#$&amp;)
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-300 dark:text-gray-400" aria-hidden="true"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                A longer password (min. 12 chars.)
                            </li>
                        </ul>
                    </div>
                    <div data-popper-arrow=""
                        style="position: absolute; left: 0px; transform: translate(138.667px, 0px);"></div>
                </div>
                <x-input-error for="password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" type="password" placeholder="••••••••" class="mt-1 block w-full"
                    wire:model="state.password_confirmation" autocomplete="new-password" />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>


        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button>
            {{ __('Save') }}
        </x-button>

        <x-action-message class="ms-3" on="saved">
            {{ __('Saved') }}
        </x-action-message>
    </x-slot>
</x-form-section>
