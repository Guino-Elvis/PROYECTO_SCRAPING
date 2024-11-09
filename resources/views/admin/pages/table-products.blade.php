@section('title', 'Tabla - Productos')
@section('header', 'Tabla')
@section('section', 'Productos')

<div>
    <div>
        @if ($isOpen)
            @include('admin.modals.product')
        @endif
        <x-card>
            <div>
                <div class="mb-2">
                    Filtrar por:
                </div>
                <div class="grid sm:grid-cols-2 gap-2 md:grid-cols-3 lg:md:grid-cols-3 xl:grid-cols-3">
                    <x-select wire:model="productCategory">
                        <x-slot name="options">
                            <option value="" selected>Categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-slot>
                    </x-select>
                    <x-select wire:model="productState">
                        <x-slot name="options">
                            <option value="">Estado</option>
                            <option value="1">Escondido</option>
                            <option value="2">Visible</option>
                        </x-slot>
                    </x-select>
                </div>
            </div>
        </x-card>
        <x-card>
            <div class="flex flex-col sm:flex-row sm:justify-between text-center gap-2 mb-4">
                <div class="flex-1">
                    <x-search />
                </div>
                <div x-data="{ open: false }" @click.away="open = false" class="flex flex-wrap justify-center gap-2"
                    align="right">
                    <x-select wire:model="amount" class="w-max">
                        <x-slot name="options">
                            <option value="5" selected>5</option>
                            <option value="10">10</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="70">70</option>
                            <option value="100">100</option>
                        </x-slot>
                    </x-select>

                    <x-button-default @click="open = ! open" id="dropdownBottomButton"
                        data-dropdown-toggle="dropdownBottom" data-dropdown-placement="bottom" type="button">
                        <i class="fa-solid fa-file-export me-1"></i>
                        Exportar
                        <i class="fa-solid fa-chevron-right ms-2 transition-transform duration-200 transform"
                            :class="{ 'rotate-90': open, 'rotate-0': !open }"></i>
                    </x-button-default>

                    <!-- Dropdown menu -->
                    <div id="dropdownBottom" class="z-10 hidden bg-white rounded-lg shadow-lg w-40 border">
                        <div class="py-2 text-sm font-medium text-zinc-700" aria-labelledby="dropdownBottomButton">
                            <x-button-hover color="green" wire:click="createCSV()" target="_blank">
                                <i class="fa-solid fa-file-csv"></i> CSV
                            </x-button-hover>
                            <x-button-hover color="green" wire:click="createExcel()" target="_blank">
                                <i class="fa-solid fa-file-excel me-1"></i> EXCEL
                            </x-button-hover>
                            <a href="{{ URL::to('/productos/pdf') }}" target="_blank">
                                <x-button-hover color="blue">
                                    <i class="fa-solid fa-file-pdf"></i> PDF
                                </x-button-hover>
                            </a>
                        </div>
                    </div>
                    <x-button wire:click="create()">
                        <i class="fa-solid fa-plus me-1"></i>
                        Agregar producto
                    </x-button>
                </div>
            </div>
            <div class="shadow border-b border-gray-200 rounded-lg overflow-auto">
                <table class="w-full table-auto">
                    <thead class="bg-indigo-600 text-white">
                        <tr class="text-center text-xs font-bold uppercase">
                            <td scope="col" class="px-6 py-3">ID</td>
                            <td scope="col" class="px-6 py-3">Imagen</td>
                            <td scope="col" class="px-6 py-3">Nombre</td>
                            <td scope="col" class="px-6 py-3">Slug</td>
                            <td scope="col" class="px-6 py-3">Stock</td>
                            <td scope="col" class="px-6 py-3">Categoria</td>
                            <td scope="col" class="px-6 py-3">Estado</td>
                            <td scope="col" class="px-6 py-3">Usuario</td>
                            <td scope="col" class="px-6 py-3">Creado</td>
                            <td scope="col" class="px-6 py-3">Actualizado</td>
                            <th scope="col" class="px-4 py-3 acciones"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300 bg-white">
                        @foreach ($products as $index => $product)
                            <tr class="text-sm font-medium text-gray-900 hover:bg-gray-100">
                                <td class="px-4 py-2">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-600 text-white">
                                        {{ $index + 1 }}
                                    </span>
                                </td>
                                <td class="p-2">
                                    <div class="flex items-center justify-center">
                                        <div class="flex">
                                            <div class="flex items-center text-right">
                                                <button onclick="prev({{ $index }})"
                                                    class="text-gray-500 hover:text-gray-600 active:text-gray-800">
                                                    <i class="fa-solid fa-circle-chevron-left fa-lg"></i>
                                                </button>
                                            </div>
                                            <div id="sliderContainer_{{ $index }}"
                                                class="w-24 h-24 shadow-sm mx-1 overflow-hidden">
                                                <ul id="slider_{{ $index }}"
                                                    class="flex w-full h-24 transition-margin-left duration-1000">
                                                    @if ($product->image)
                                                        @foreach ($product->images as $image)
                                                            <li class="w-full flex items-center justify-center">
                                                                <div
                                                                    class="w-24 rounded-lg overflow-hidden flex items-center justify-center">
                                                                    <img class="w-[90px] h-[90px] object-cover rounded-lg"
                                                                        src="{{ Storage::url($image->url) }}" />
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <li class="w-full flex items-center justify-center">
                                                            <div
                                                                class="w-24 rounded-lg overflow-hidden flex items-center justify-center">
                                                                <img class="w-[90px] h-[90px] object-cover rounded-lg"
                                                                    src="/assets/img/default.png" />
                                                            </div>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="flex items-center">
                                                <button onclick="next({{ $index }})"
                                                    class="text-gray-500 hover:text-gray-600 active:text-gray-800">
                                                    <i class="fa-solid fa-circle-chevron-right fa-lg"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-center">{{ $product->name }}</td>
                                <td class="px-4 py-2 text-center">{{ $product->slug }}</td>
                                <td class="px-4 py-2 text-center">{{ $product->stock }}</td>
                                <td class="px-4 py-2 text-center">
                                    @if ($product['category'])
                                        {{ optional(json_decode($product['category'], true))['name'] }}
                                    @else
                                        {{ $product->category->name }}
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex justify-center items-center">
                                        @if ($product->state == 1)
                                            <span
                                                class="bg-amber-100 text-amber-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                Escondido
                                            </span>
                                        @else
                                            <span
                                                class="bg-green-100 text-green-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                Visible
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-center">{{ $product->user->name }}</td>
                                <td class="px-4 py-2 text-center">{{ $product->created_at }}</td>
                                <td class="px-4 py-2 text-center">{{ $product->updated_at }}</td>
                                <td class="px-4 py-2 acciones space-y-2 w-10">
                                    <x-button-success wire:click="edit({{ $product }})">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </x-button-success>
                                    <x-button-danger wire:click="$emit('deleteItem',{{ $product->id }})">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </x-button-danger>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($products->count() == 0 && $search == '')
                <div class="text-center pt-4">
                    <span class="text-slate-600 mt-2 text-sm">Ningún dato disponible en esta tabla</span>
                </div>
            @elseif ($products->count() == 0 && $search != '')
                <div class="flex h-auto items-center justify-center p-5 bg-white w-full rounded-lg shadow-lg">
                    <div class="text-center">
                        <div class="inline-flex rounded-full bg-yellow-100 p-4">
                            <div class="rounded-full text-yellow-600 bg-yellow-200 p-4 text-6xl">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </div>
                        </div>
                        <h1 class="mt-5 text-2xl font-bold text-slate-800">Ups... algo salio mal</h1>
                        <p class="text-slate-600 mt-2 text-base">No existe ningun registro coincidente con la busqueda
                        </p>
                        <span class="text-slate-600 mt-2 text-base">Por favor ingrese el texto correctamente</span>
                    </div>
                </div>
            @endif
            @if ($products->hasPages())
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            @endif
        </x-card>

    </div>

    <!--Scripts - Sweetalert   -->
    @push('js')
        <script>
            function next(index) {
                let sliderContainer = document.getElementById('sliderContainer_' + index);
                let slider = document.getElementById('slider_' + index);
                let cards = slider.getElementsByTagName('li');

                let elementsToShow = 1;
                let sliderContainerWidth = sliderContainer.clientWidth;
                let cardWidth = sliderContainerWidth / elementsToShow;

                let marginLeft = +slider.style.marginLeft.slice(0, -2);
                let maxMarginLeft = -cardWidth * (cards.length - elementsToShow);

                if (marginLeft > maxMarginLeft) {
                    slider.style.marginLeft = (marginLeft - cardWidth) + 'px';
                } else {
                    slider.style.marginLeft = '0px';
                }
            }

            function prev(index) {
                let sliderContainer = document.getElementById('sliderContainer_' + index);
                let slider = document.getElementById('slider_' + index);
                let cards = slider.getElementsByTagName('li');

                let elementsToShow = 1;
                let sliderContainerWidth = sliderContainer.clientWidth;
                let cardWidth = sliderContainerWidth / elementsToShow;

                let marginLeft = +slider.style.marginLeft.slice(0, -2);

                if (marginLeft < 0) {
                    slider.style.marginLeft = (marginLeft + cardWidth) + 'px';
                } else {
                    let maxMarginLeft = -cardWidth * (cards.length - elementsToShow);
                    slider.style.marginLeft = maxMarginLeft + 'px';
                }
            }
        </script>

        <script>
            Livewire.on('deleteItem', id => {
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórralo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //alert("del");
                        Livewire.emitTo('table-products', 'delete', id);
                        Swal.fire(
                            '¡Eliminado!',
                            'Su archivo ha sido eliminado.',
                            'success'
                        )

                    }
                })
            });
        </script>
    @endpush
</div>
