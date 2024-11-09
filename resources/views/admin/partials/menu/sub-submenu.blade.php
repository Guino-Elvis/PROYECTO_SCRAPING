<ul class="menu-sub">
    @if (isset($menu))
        <div class="transform transition duration-300 ease-in-out" x-cloak x-show="open2" x-collapse
            x-collapse.duration.500ms>
            <div class="">
                <ul class="space-y-1 mt-1">
                    @foreach ($menu as $submenu)
                        <li>
                            <x-sidebar-item-link
                                href="{{ isset($submenu['url']) ? (filter_var($submenu['url'], FILTER_VALIDATE_URL) ? $submenu['url'] : route($submenu['url'])) : 'javascript:void(0)' }}"
                                :active="request()->routeIs($submenu['slug'])">
                                @isset($submenu['icon'])
                                    <x-slot name="logo">
                                        {{ $submenu['icon'] }}
                                    </x-slot>
                                @endisset
                                {{ isset($submenu['name']) ? $submenu['name'] : '' }}
                            </x-sidebar-item-link>
                            {{-- submenu --}}
                            @if (isset($submenu['submenu']))
                                @include('admin.partials.menu.submenu', [
                                    'menu' => $submenu['submenu'],
                                ])
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</ul>
