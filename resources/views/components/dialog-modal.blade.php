@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="p-4 text-base font-medium text-gray-900 sticky z-0 top-0 bg-white border border-b-gray-300">
        {{ $title }}
    </div>

    <div class="p-4 text-sm text-gray-600 overflow-y-auto">
        {{ $content }}
    </div>

    <div class="flex flex-row gap-2 justify-center px-6 py-4 sticky z-0 bottom-0 bg-white border border-t-gray-300">
        {{ $footer }}
    </div>
</x-modal>
