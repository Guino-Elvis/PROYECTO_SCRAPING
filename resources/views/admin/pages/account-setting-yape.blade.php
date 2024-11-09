@section('title', 'Configurar cuenta - Yape')
@section('header', 'Configurar cuenta')
@section('section', 'Yape')

<div>
    <div class="grid grid-cols-1 xl:grid-cols-3 xl:gap-4">

        <div class="col-span-2">

            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg 2xl:col-span-2">
                <h3 class="mb-4 text-xl font-semibold">Información General</h3>
                <form action="">
                    <div x-data="{ photoName: null, photoPreview: null }" class="mb-4 items-center flex gap-4">
                        <!-- Profile Photo File Input -->
                        <input type="file" id="photo" class="hidden" x-ref="photo"
                            x-on:change="
                                            photoName = $refs.photo.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                photoPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.photo.files[0]);
                                    " />

                        <!-- Current Profile Photo -->
                        <div x-show="! photoPreview" class="p-2 rounded-lg bg-[#860098]">
                            <img src="https://www.ocu.org/-/media/ta/images/_%20orphaned/qr-code.png?rev=2e1cc496-40d9-4e21-a7fb-9e2c76d6a288&hash=38DA21F2DF33F4BB3CE83BE5D2A723F5&mw=960" alt=""
                                class="rounded-lg w-44 sm:w-28 h-28 bg-cover">

                        </div>

                        <!-- New Profile Photo Preview -->
                        <div x-show="photoPreview" style="display: none;">
                            <span class="block rounded-lg w-28 h-28  bg-cover"
                                x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>

                        <div>
                            <h3 class="mb-1 text-xl font-bold text-gray-900">
                                Imagen de QR</h3>
                            <div class="mb-4 text-sm text-gray-500">
                                JPG, JPEG o PNG. Tamaño máximo de 1MB
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
                                    Subir imagen
                                </x-button>

                                <x-input-error for="photo" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900">Nombre del
                                titular</label>
                            <input type="text" name="last-name" id="name"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                placeholder="Green" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900">Numero de
                                celular</label>
                            <input type="text" name="last-name" id="phone"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                placeholder="Green" required="">
                        </div>
                    </div>
                    <div class="flex items-center justify-start mt-6 text-end">
                        <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store, image">
                            {{ __('Guardar') }}
                        </x-button>

                        <x-action-message class="ms-3" on="saved">
                            {{ __('Guardado') }}
                        </x-action-message>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-span-full xl:col-auto">
            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg 2xl:col-span-2">
                <img class="rounded-lg w-full h-40 object-cover" src="https://tubolsillo.pe/wp-content/uploads/2023/08/como-activar-sonido-de-yape-en-mi-celular-notificacion.jpg" alt="">
            </div>

            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg 2xl:col-span-2">
                <img class="rounded-lg w-full h-28 object-cover" src="https://www.tarjetasdecredito.vip/wp-content/uploads/2022/11/Yape-del-BCP-como-funciona.webp" alt="">
            </div>
        </div>
    </div>
</div>
