
<div class="text-center text-white text-sm py-1 bg-indigo-600 rounded-t-lg">
    {{ $title }}
</div>
<div class="flex justify-between pt-4 px-4 text-zinc-600 group-hover:text-indigo-600">
    <div>
        <h1 class="text-4xl font-semibold">
            {{ $amount }}
        </h1>
        <div class="text-sm">
            en total
        </div>
    </div>
    <div>
        {{ $slot }}
    </div>
</div>
