<ul class="menu-sub">
    @if (isset($menu))
        <div class="transform transition duration-300 ease-in-out" x-cloak x-show="open" x-collapse
            x-collapse.duration.500ms>
            <div class="">
                <ul class="space-y-1 mt-1">
                    @foreach ($menu as $submenu)
                        @php
                            $sub_submenu = [];
                            if (isset($submenu['submenu'])) {
                                foreach ($submenu['submenu'] as $value) {
                                    $sub_submenu[] = $value['slug'];
                                }
                            }
                        @endphp
                        <div class="relative" x-data="{ open2: {{ in_array(request()->route()->getName(), $sub_submenu) ? 'true' : 'false' }} }">
                            @if (isset($submenu['submenu']))
                                <x-sidebar-submenu @click="open2 = !open2" :active="in_array(request()->route()->getName(), $sub_submenu)">
                                    <x-slot name="logo">
                                        @isset($submenu['icon'])
                                            <i class="{{ $submenu['icon'] }}"></i>
                                        @endisset
                                    </x-slot>
                                    {{ isset($submenu['name']) ? $submenu['name'] : '' }}
                                </x-sidebar-submenu>
                            @else
                                <x-sidebar-item-link
                                    href="{{ isset($submenu['url']) ? (filter_var($submenu['url'], FILTER_VALIDATE_URL) ? $submenu['url'] : route($submenu['url'])) : 'javascript:void(0)' }}"
                                    :active="isset($submenu['url']) && request()->routeIs($submenu['url'])">
                                    @isset($submenu['icon'])
                                        <x-slot name="logo">
                                            {{ $submenu['icon'] }}
                                        </x-slot>
                                    @endisset
                                    {{ isset($submenu['name']) ? $submenu['name'] : '' }}
                                </x-sidebar-item-link>
                            @endif
                            {{-- submenu --}}
                            @if (isset($submenu['submenu']))
                                @include('admin.partials.menu.sub-submenu', [
                                    'menu' => $submenu['submenu'],
                                ])
                            @endif
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</ul>
