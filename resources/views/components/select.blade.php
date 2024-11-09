@props(['disabled' => false])

<select {!! $attributes->merge([
    'class' => 'text-zinc-500 text-sm border-zinc-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm w-full',
]) !!}>
    {{ $options }}
</select>
