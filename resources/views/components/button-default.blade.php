<button data-ripple-light="true" {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-zinc-700 to-zinc-600 active:from-zinc-600 active:to-zinc-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest active:outline-none active:ring-2 active:ring-zinc-500 active:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
