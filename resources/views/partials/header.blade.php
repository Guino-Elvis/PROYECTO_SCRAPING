<div class="bg-black">
    <div
        class="sm:flex sm:justify-between items-center gap-2 text-gray-200 text-xs md:text-sm px-6 py-1 sm:flex-none max-w-[1366px] mx-auto">

        <ul class="flex space-x-4 justify-center flex-wrap items-center">
            <li class="flex items-center">
                <i class="fa-brands fa-whatsapp mr-1"></i>
                <a class="hover:text-indigo-500 font-normal" target="_blank"
                    href="https://api.whatsapp.com/send?phone=+51981141413&text=Hola, Nececito mas informacion!">
                    +51 981141413
                </a>
            </li>
            <li class="flex items-center">
                <i class="fa-solid fa-envelope mr-1"></i>
                <a class="hover:text-indigo-500 font-normal"
                    href="mailto:ventas@BOLSALABORAL.com">ventas@BOLSALABORAL.com</a>
            </li>
        </ul>
        <div class="flex gap-3 justify-center items-center mt-1 sm:mt-0">
            <div class="sm:flex sm:items-center">
                <!-- Settings Dropdown -->
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex">
                                <button aria-label="user"
                                    class="px-3 py-1 flex items-center gap-2 rounded-lg border focus:bg-black active:bg-zinc-700">
                                    <img class="w-6"
                                        src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Flag_of_Spain.svg"
                                        alt="">
                                    <div>
                                        <span class="text-xs">ESP </span>/<span class="font-bold"> PEN</span>
                                    </div>
                                    <i :class="{ 'hidden': open, 'inline-flex': !open }"
                                        class="fa-solid fa-chevron-down fa-xs -mr-0.5"></i>
                                    <i :class="{ 'hidden': !open, 'inline-flex': open }"
                                        class="fa-solid fa-chevron-up fa-xs -mr-0.5"></i>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400 bg-gray-100">
                                Idiomas Disponibles
                            </div>

                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <x-dropdown-link
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    <div class="flex items-center gap-2">
                                        <img class="w-6 h-4 object-cover" src="{{ $properties['flag'] }}"
                                            alt="{{ $properties['native'] }}">
                                        <div>
                                            <span>{{ $properties['native'] }}</span> / <span
                                                class="font-bold">{{ $properties['currency'] }}</span>
                                        </div>
                                    </div>
                                </x-dropdown-link>
                            @endforeach

                            <div class="border-t border-gray-100"></div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>


        </div>
    </div>
</div>
