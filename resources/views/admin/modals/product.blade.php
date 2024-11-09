<div>
    <x-dialog-modal wire:model="isOpen" maxWidth="lg">
        <x-slot name="title">
            @if ($ruteCreate)
                <h3 class="text-center">Registrar nuevo producto</h3>
            @else
                <h3 class="text-center">Actualizar producto</h3>
            @endif
        </x-slot>
        <x-slot name="content">
            <form autocomplete="off" wire:keydown.enter.prevent="store()">
                <input type="hidden" wire:model="product.id">
                <div class="w-full px-2">
                    <div class="mb-1">
                        <x-label value="Nombre" class="font-bold" />
                        <x-input type="text" wire:model="product.name" class="w-full" />
                        @unless (!empty($product['name']))
                            <x-input-error for="product.name" />
                        @endunless
                    </div>
                    <div class="mb-1">
                        <x-label value="Slug" class="font-bold" />
                        <x-input type="text" wire:model="product.slug" class="w-full" disabled />
                        @unless (!empty($product['slug']))
                            <x-input-error for="product.slug" />
                        @endunless
                    </div>
                    <div class="mb-1">
                        <x-label value="Stock" class="font-bold" />
                        <x-input type="text" wire:model.live="product.stock" class="w-full" />
                        @unless (!empty($product['stock']))
                            <x-input-error for="product.stock" />
                        @endunless
                    </div>
                    <div class="flex flex-col sm:flex-row gap-2.5">
                        <div class="flex-auto">
                            <x-label value="Estado" class="font-bold" />
                            <x-select wire:model="product.state">
                                <x-slot name="options">
                                    @if ($ruteCreate)
                                        <option value="" selected>Seleccione...</option>
                                        <option value="1">Escondido</option>
                                        <option value="2">Visible</option>
                                    @else
                                        @if ($product['state'] == 1)
                                            <option value="{{ $product['state'] }}" selected>Escondido</option>
                                            <option value="2">Visible</option>
                                        @else
                                            <option value="{{ $product['state'] }}" selected>Visible</option>
                                            <option value="1">Escondido</option>
                                        @endif
                                    @endif
                                </x-slot>
                            </x-select>
                            @unless (!empty($product['state']))
                                <x-input-error for="product.state" />
                            @endunless
                        </div>
                        <div class="flex-auto">
                            <x-label value="Categoria" class="font-bold" />
                            <x-select wire:model="product.category_id">
                                <x-slot name="options">
                                    @if ($ruteCreate)
                                        <option value="" selected>Seleccione...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="{{ $product['category_id'] }}" selected>
                                            {{ $categories->firstWhere('id', $product['category_id'])->name }}
                                        </option>
                                        @foreach ($categories as $category)
                                            @if ($category->id !== $product['category_id'])
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </x-slot>
                            </x-select>
                            @unless (!empty($product['category_id']))
                                <x-input-error for="product.category_id" />
                            @endunless
                        </div>
                        <input hidden wire:model="product.user" />
                    </div>
                    <input hidden wire:model="product.user_id" />
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-button-danger wire:click="$set('isOpen',false)">Cancelar</x-button-danger>
            <x-button-success wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store"
                class="disabled:opacity-25">
                @if ($ruteCreate)
                    Registrar
                @else
                    Actualizar
                @endif
            </x-button-success>
        </x-slot>

    </x-dialog-modal>
</div>
