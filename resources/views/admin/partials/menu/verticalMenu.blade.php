@php
    $menuData = json_decode(file_get_contents(resource_path('menu/verticalMenu.json')), true);
    $user = Auth::user();

    // variable para almacenar los menús del usuario
    $userMenus = [];

    // Verificar si el usuario está autenticado y tiene roles asignados
    if ($user && $user->roles->isNotEmpty()) {
        $userRoleName = $user->roles->first()->name;
        $userRoles = $user->roles->pluck('name')->toArray();

        // Filtramos los menús según el rol del usuario
        $userMenus = collect($menuData['menu'])
            ->filter(function ($menu) use ($userRoleName) {
                // Verificamos si el menú tiene roles y si el rol del usuario está presente en esos roles
                return isset($menu['roles']) && in_array($userRoleName, $menu['roles']);
            })
            ->map(function ($menu) use ($userRoleName) {
                // Filtrar los submenús según el rol del usuario
                if (isset($menu['submenu'])) {
                    $menu['submenu'] = array_filter($menu['submenu'], function ($submenu) use ($userRoleName) {
                        // Verificar si el submenú tiene roles definidos y si el rol del usuario está presente en esos roles
                        return isset($submenu['roles']) && in_array($userRoleName, $submenu['roles']);
                    });
                }
                return $menu;
            })
            ->filter(function ($menu) use ($userRoleName) {
                // Filtramos los menuHeader según el rol del usuario
                return !isset($menu['menuHeader']) ||
                    (isset($menu['roles']) && in_array($userRoleName, $menu['roles']));
            })
            ->toArray();
    }
@endphp
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full lg:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full bg-[#4D73DF] border-r">
        <div class="flex items-center justify-center sticky z-10 top-0 h-16 bg-[#4D73DF]">
            <a href="#" title="home">
                <div class="flex gap-4 items-center self-center">
                    <img src="{{ asset('assets/img/favicon/favicon.ico') }}" alt class="w-12 ml-[-10px]">
                    <div class="flex flex-col text-white ">
                        <span class="text-base font-bold italic"> Bienvenido al</span>
                        <span class="text-sm italic -mt-1"> Panel de Control </span>
                    </div>
                </div>
            </a>
        </div>
        <div class="scroll-pos px-3 py-2 overflow-y-auto" style="height: calc(100vh - 8rem)">
            <ul class="space-y-2 font-medium">
                @foreach ($userMenus as $menu)
                    @if (isset($menu['menuHeader']))
                        @php
                            $showMenuHeader =
                                isset($menu['roles']) && count(array_intersect($menu['roles'], $userRoles)) > 0;
                        @endphp
                        @if ($showMenuHeader)
                            <li class="flex items-center py-2 text-white">
                                <span class="w-1/12 h-0.5 bg-gradient-to-l to-gray-100 from-gray-300"></span>
                                <span class="flex-none text-xs mx-1 uppercase">{{ $menu['menuHeader'] }}</span>
                                <span class="w-full h-0.5 bg-gradient-to-r to-gray-100 from-gray-300"></span>
                            </li>
                        @endif
                    @else
                        @php
                            $primer_slug = [];
                            $slugs = [];

                            if (isset($menu['submenu'])) {
                                foreach ($menu['submenu'] as $segundoSubmenu) {
                                    $primer_slug[] = $segundoSubmenu['slug'];
                                    if (isset($segundoSubmenu['submenu'])) {
                                        foreach ($segundoSubmenu['submenu'] as $sub_submenu_item) {
                                            if (isset($sub_submenu_item['slug'])) {
                                                $slugs[] = $sub_submenu_item['slug'];
                                            }
                                        }
                                    }
                                }
                            }
                            $filteredSubmenuSlugs = array_merge($primer_slug, $slugs);
                        @endphp
                        <div class="relative" x-data="{ open: {{ in_array(request()->route()->getName(), $primer_slug) || in_array(request()->route()->getName(), $slugs) ? 'true' : 'false' }} }">
                            @if (isset($menu['submenu']))
                                <x-sidebar-menu @click="open = !open" :active="in_array(request()->route()->getName(), $primer_slug) ||
                                    in_array(request()->route()->getName(), $slugs)">
                                    <x-slot name="logo">
                                        @isset($menu['icon'])
                                            <i class="{{ $menu['icon'] }}"></i>
                                        @endisset
                                    </x-slot>
                                    {{ isset($menu['name']) ? $menu['name'] : '' }}
                                </x-sidebar-menu>
                            @else
                                <x-sidebar-link target="{{ isset($menu['target']) ? $menu['target'] : '' }}"
                                    href="{{ isset($menu['url']) ? (filter_var($menu['url'], FILTER_VALIDATE_URL) ? $menu['url'] : route($menu['url'])) : 'javascript:void(0)' }}"
                                    :active="isset($menu['url']) && request()->routeIs($menu['url'])">
                                    <x-slot name="logo">
                                        @isset($menu['icon'])
                                            <i class="{{ $menu['icon'] }}"></i>
                                        @endisset
                                    </x-slot>
                                    {{ isset($menu['name']) ? $menu['name'] : '' }}
                                </x-sidebar-link>
                            @endif

                            @isset($menu['submenu'])
                                @include('admin.partials.menu.submenu', ['menu' => $menu['submenu']])
                            @endisset
                        </div>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="p-3 sticky z-10 bottom-0 h-16 bg-[#4D73DF] border-t">
            <ul class="">
                <form method="POST" action="{{ route('logout_user') }}" x-data>
                    @csrf
                    <x-sidebar-link href="{{ route('logout_user') }}" @click.prevent="$root.submit();">
                        <x-slot name="logo">
                            <i class="fa-solid fa-power-off"></i>
                        </x-slot>
                        <samp class="text-white hover:text-blue-400">Cerrar sesión</samp>
                    </x-sidebar-link>
                </form>
            </ul>
        </div>
    </div>
</aside>

<script src="{{ asset('assets/js/scroollbar-position.js') }}"></script>
