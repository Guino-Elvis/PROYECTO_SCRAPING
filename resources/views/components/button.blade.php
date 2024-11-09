<button data-ripple-light="true" {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-3 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 active:from-blue-600 active:to-indigo-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-widest active:outline-none active:ring-2 active:ring-indigo-500 active:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
