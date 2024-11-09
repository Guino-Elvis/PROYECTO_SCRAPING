<nav x-data="{ open: false }" class="bg-white border-b border-b-gray-400 sticky top-0 z-50">

    <!-- Primary Navigation Menu -->
    <div class="mx-auto  sm:px-6 pt-4 ">
        <div class="flex  items-center justify-between">

            <div class="  flex flex-row gap-4 justify-center  items-center">
                <a href="/">
                    <img class="h-13 w-16 md:w-[6rem] object-contain" src="/img/paypal.jpg" alt="">
                </a>
                <div class="hidden md:block">
                    <div class="flex flex-row gap-4 justify-center  items-center">
                        <div
                            class="pt-4 pb-2 border-b-2 border-transparent hover:border-blue-700  active:border-blue-700 items-center gap-2 text-black text-xs md:text-sm px-6  sm:flex-none ">
                            <a href="/" class="flex items-center py-2">
                                {{ trans('Inicio') }}
                            </a>
                        </div>
                        <div
                            class="pt-4 pb-2 border-b-2 border-transparent hover:border-blue-700  active:border-blue-700 items-center gap-2 text-black text-xs md:text-sm px-6  sm:flex-none ">
                            <a href="/" class="flex items-center py-2">
                                {{ trans('Evaluaciones de empresa') }}
                            </a>
                        </div>
                        <div
                            class="pt-4 pb-2 border-b-2 border-transparent hover:border-blue-700  active:border-blue-700 items-center gap-2 text-black text-xs md:text-sm px-6  sm:flex-none ">
                            <a href="/" class="flex items-center py-2">
                                {{ trans('Buscar sueldos') }}
                            </a>
                        </div>
                        @role('Administrador')
                            <div
                                class="pt-4 pb-2 border-b-2 border-transparent hover:border-blue-700  active:border-blue-700 items-center gap-2 text-black text-xs md:text-sm px-6  sm:flex-none ">

                                <a href="{{ route('dashboard-general') }}"
                                    :active="request() - > routeIs('dashboard-general')" class="flex items-center py-2">
                                    {{ __('Sistema') }}
                                </a>

                            </div>
                        @endrole
                    </div>
                </div>
            </div>

            <div class="  flex flex-row gap-4 justify-center items-center ">
                <div
                    class="pt-4 pb-4 border-b-2 border-transparent hover:border-blue-700  active:border-blue-700 items-center gap-2 text-black text-xs md:text-sm px-6  sm:flex-none ">
                    <div class="relative  py-1">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex">
                                    <button aria-label="user" class=" flex items-center gap-2">
                                        <img class="w-6"
                                            src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Flag_of_Spain.svg"
                                            alt="">
                                        <div>
                                            <span class="text-xs">ESPAÑOL </span>
                                        </div>

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
                                                <span>{{ $properties['native'] }}</span>
                                            </div>
                                        </div>
                                    </x-dropdown-link>
                                @endforeach

                                <div class="border-t border-gray-100"></div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                <span class="hidden md:block border-e h-6 mx-4 border-gray-400"></span>
                <div class="hidden md:block">
                    <div
                        class="pt-4 pb-4 border-b-2 border-transparent hover:border-blue-700  active:border-blue-700 items-center gap-2 text-black text-xs md:text-sm px-6  sm:flex-none ">
                        <a href="/" class="flex items-center  py-1">
                            <span class="font-extrabold text-gray-600 flex">
                                {{ trans('Empresas') }}
                                & {{ trans('Publicar empleos') }}</span>
                        </a>
                    </div>
                </div>

                <span class="border-e h-6 mx-4 border-gray-400"></span>
                <div class="flex pt-4 pb-4 border-b-2 border-transparent hover:border-blue-700  active:border-blue-700">
                    @auth
                        <div class="flex items-center">
                            <!-- Settings Dropdown -->
                            <div class="relative">
                                <x-dropdown align="right" width="48">

                                    <x-slot name="trigger">
                                        <span class="inline-flex">
                                            <button
                                                class=" flex items-center justify-center gap-1  active:bg-zinc-300 group">
                                                <i
                                                    class='bx bx-user text-lg text-gray-500 group-hover:text-black duration-500'></i>

                                                <div class="hidden md:block">
                                                    <div class="text-sm flex-none w-max">
                                                        <div class="flex flex-col">
                                                            <span
                                                                class="font-extrabold flex-1 max-w-[10rem] whitespace-nowrap overflow-hidden text-ellipsis">
                                                                {{ Auth::user()->name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </button>
                                        </span>
                                    </x-slot>

                                    <x-slot name="content">
                                        <!-- Account Management -->
                                        <div class="px-4  bg-gray-100 -mt-1 rounded-t-md text-center">
                                            <div class="font-medium text-sm text-gray-800">{{ Auth::user()->name }}</div>
                                            <div class="font-medium text-xs text-gray-500">{{ Auth::user()->email }}</div>
                                        </div>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Administrar Cuenta') }}
                                        </div>

                                        <x-dropdown-link href="{{ route('configurar-cuenta-perfil') }}" >
                                            {{ __('Perfil') }}
                                        </x-dropdown-link>

                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                                {{ __('API Tokens') }}
                                            </x-dropdown-link>
                                        @endif

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout_user') }}" x-data>
                                            @csrf
                                            <x-dropdown-link href="{{ route('logout_user') }}" @click.prevent="$root.submit();">
                                                <i class="fa-solid fa-power-off mr-2"></i>
                                                {{ __('Cerrar sesión') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    @else
                        <a href="/login-bolsa" class="px-2 py-1 flex items-center gap-1  active:bg-zinc-300 group">
                            <div class="text-sm flex-none w-max">
                                <div class="flex flex-col">

                                    <span
                                        class="font-extrabold text-[#2557a7] flex-1 max-w-[10rem] whitespace-nowrap overflow-hidden text-ellipsis">
                                        {{ trans('Inicia sesion') }}
                                        / {{ trans('Regístrate') }}</span>
                                </div>
                            </div>
                        </a>
                    @endauth
                    <div class="lg:hidden md:hidden flex items-center pl-5">
                        <button @click="open = ! open"
                            class="block md:hidden items-center justify-center px-2 py-1 rounded-md border border-zinc-300 active:bg-zinc-300">
                            <i :class="{ 'hidden': open, 'inline-flex': !open }" class="fa-solid fa-bars"></i>
                            <i :class="{ 'hidden': !open, 'inline-flex': open }" class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link>
                {{ __('Productos') }}
            </x-responsive-nav-link>

            @role('Administrador')
                <x-responsive-nav-link href="{{ route('dashboard-general') }}" target="_blank" :active="request()->routeIs('dashboard-general')">
                    {{ __('Sistema') }}
                </x-responsive-nav-link>
            @endrole
        </div>
    </div>




</nav>
