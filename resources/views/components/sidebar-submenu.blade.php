@props(['active'])

@php
$classes = ($active ?? false)
            ? 'w-full relative px-4 py-2 flex justify-between items-center align-middle rounded-xl text-gray-600 bg-gray-100'
            : 'w-full px-4 py-2 flex justify-between items-center align-middle rounded-xl text-gray-600 group hover:text-indigo-600 hover:bg-gray-100 active:bg-gray-200';
@endphp

<li>
    <button {{ $attributes->merge(['class' => $classes]) }}>
        <div class="flex space-x-2 items-center">
            <div class="h-6 w-6 flex justify-center items-center">
                {{ $logo }}
            </div>
            <div class="font-medium text-sm text-left w-36 whitespace-nowrap overflow-hidden text-ellipsis">{{ $slot }}</div>
        </div>
        <div class="h-6 w-6 flex justify-center items-center">
            <i class="fa-solid fa-chevron-right fa-xs transition-transform duration-200 transform" :class="{ 'rotate-90': open2, 'rotate-0': !open2 }"></i>
        </div>
    </button>
</li>
