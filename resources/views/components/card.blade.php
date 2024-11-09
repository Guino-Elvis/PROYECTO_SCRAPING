@props(['col'])

@php
    $col = [
        '1' => 'col-span-1',
        '2' => 'sm:col-auto md:col-span-3 lg:col-span-2 xl:col-span-2',
        '3' => 'sm:col-auto md:col-span-3 lg:col-span-2 xl:col-span-3',
        '4' => 'col-span-4',
        '5' => 'col-span-5',
    ][$col ?? '1'];
@endphp

<div class="{{ $col }}">
    <div {{ $attributes->merge(['class' => 'p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg']) }}>
        {{ $slot }}
    </div>
</div>
