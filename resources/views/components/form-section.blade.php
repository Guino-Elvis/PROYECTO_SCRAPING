@props(['submit'])

<div {{ $attributes->merge(['class' => '']) }}>
    {{ $title }}

    <div class="">
        <form wire:submit="{{ $submit }}">
            <div class="2xl:col-span-2">
                {{ $form }}
            </div>

            @if (isset($actions))
                <div
                    class="flex items-center justify-start mt-6 text-end">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
