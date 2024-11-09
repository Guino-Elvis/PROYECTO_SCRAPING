@props(['color' => 'black'])

<button data-ripple-light="true"
    {{ $attributes->merge(['type' => 'button', 'class' => 'px-4 py-2 flex gap-2 w-full items-center hover:text-' . $color . '-600 hover:bg-zinc-100 tracking-wide']) }}>
    {{ $slot }}
</button>
