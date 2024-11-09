@include('admin.partials.menu.verticalMenu')

{{-- Content --}}
<div class="lg:ml-64">

    @include('admin.partials.navbar.navbar')

    <div class="flex flex-col justify-between" style="min-height: calc(100vh - 4rem)">

        <div class="p-6">

            <div class="mb-4">
                <span class="text-zinc-500">@yield('header')</span>
                / <span class="font-semibold">@yield('section')</span>
            </div>

            {{ $content }}

        </div>

        <div class="">
            @include('admin.partials.footer.footer')
        </div>

    </div>
</div>
