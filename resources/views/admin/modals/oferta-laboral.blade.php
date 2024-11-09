<div>
    <x-dialog-modal wire:model="isOpen" maxWidth="lg">
        <x-slot name="title">
            @if ($ruteCreate)
                <h3 class="text-center">Registrar nueva Oferta Laboral</h3>
            @else
                <h3 class="text-center">Actualizar Oferta Laboral</h3>
            @endif
        </x-slot>
        <x-slot name="content">
            <form autocomplete="off">

                <input type="hidden" wire:model="oferta_laboral.id">
                <div class="flex flex-col sm:flex-row gap-2.5 w-full px-2">
                    <div class="flex flex-col gap-2.5 w-full">
                        <div class="mb-1 w-full">
                            <x-label value="Titulo " class="font-bold" />
                            <x-input class="w-full" type="text" wire:model="ofertaLaboral.titulo" />
                            @unless (!empty($ofertaLaboral['titulo']))
                                <x-input-error for="ofertaLaboral.titulo" />
                            @endunless
                        </div>
                        <div>
                            <x-label value="Descripcion de la ofertaLaboral" class="font-bold" />
                            <x-input class="w-full" type="text" wire:model="ofertaLaboral.descripcion" />
                            @unless (!empty($ofertaLaboral['descripcion']))
                                <x-input-error for="ofertaLaboral.descripcion" />
                            @endunless
                        </div>
                        <div>
                            <x-label value="Detalles de la ofertaLaboral" class="font-bold" />
                            <textarea class="w-full rounded-md" wire:model="ofertaLaboral.body"></textarea>
                            @unless (!empty($ofertaLaboral['body']))
                                <x-input-error for="ofertaLaboral.body" />
                            @endunless
                        </div>
                        <div class="mb-1 w-full">
                            <x-label value="Ubicacion " class="font-bold" />
                            <x-input class="w-full" type="text" wire:model="ofertaLaboral.ubicacion" />
                            @unless (!empty($ofertaLaboral['ubicacion']))
                                <x-input-error for="ofertaLaboral.ubicacion" />
                            @endunless
                        </div>
                        <div class="flex flex-row gap-2.5 justify-start">
                            <div class="w-1/2">
                                <x-label value="Remuneracion de la ofertaLaboral" class="font-bold" />
                                <x-input class="w-full" type="text" wire:model="ofertaLaboral.remuneracion" />
                                @unless (!empty($ofertaLaboral['remuneracion']))
                                    <x-input-error for="ofertaLaboral.remuneracion" />
                                @endunless
                            </div>
                            <div class="w-1/2">
                                <x-label value="Limite de postulantes" class="font-bold" />
                                <x-input class="w-full" type="text" wire:model="ofertaLaboral.limite_postulante" />
                                @unless (!empty($ofertaLaboral['limite_postulante']))
                                    <x-input-error for="ofertaLaboral.limite_postulante" />
                                @endunless
                            </div>
                        </div>

                        <div class="flex flex-row gap-2.5 justify-start">
                            <div class="flex-auto">
                                <x-label value="Fecha de Inicio" class="font-bold" />
                                <x-input class="w-full" type="date" wire:model="ofertaLaboral.fecha_inicio" />
                                @unless (!empty($ofertaLaboral['fecha_inicio']))
                                    <x-input-error for="ofertaLaboral.fecha_inicio" />
                                @endunless
                            </div>
                            <div class="flex-auto">
                                <x-label value="Fecha de Cierre" class="font-bold" />
                                <x-input class="w-full" type="date" wire:model="ofertaLaboral.fecha_fin" />
                                @unless (!empty($ofertaLaboral['fecha_fin']))
                                    <x-input-error for="ofertaLaboral.fecha_fin" />
                                @endunless
                            </div>
                        </div>


                        <div class="flex flex-col sm:flex-row gap-2.5">
                            <div class="flex-auto">
                                <x-label value="Estado" class="font-bold" />
                                <x-select wire:model="ofertaLaboral.state">
                                    <x-slot name="options">
                                        <option value="" selected>Seleccione...</option>
                                        <option value="1"
                                            {{ $ofertaLaboral['state'] ?? '' == 1 ? 'selected' : '' }}>
                                            Escondido
                                        </option>
                                        <option value="2"
                                            {{ $ofertaLaboral['state'] ?? '' == 2 ? 'selected' : '' }}>
                                            Visible
                                        </option>
                                    </x-slot>
                                </x-select>
                                @error('ofertaLaboral.state')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex-auto">
                                <x-label value="Empresa" class="font-bold" />
                                <x-select wire:model="ofertaLaboral.empresa_id">
                                    <x-slot name="options">
                                        <option value="" selected>Seleccione...</option>
                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa->id }}"
                                                {{ $ofertaLaboral['empresa_id'] ?? '' == $empresa->id ? 'selected' : '' }}>
                                                {{ $empresa->ra_social }}
                                            </option>
                                        @endforeach
                                    </x-slot>
                                </x-select>
                                @error('ofertaLaboral.empresa_id')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="flex-auto">
                                <x-label value="Categoria Laboral" class="font-bold" />
                                <x-select wire:model="ofertaLaboral.category_id">
                                    <x-slot name="options">
                                        <option value="" selected>Seleccione...</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $ofertaLaboral['category_id'] ?? '' == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                            </option>
                            @endforeach
        </x-slot>
        </x-select>
        @error('ofertaLaboral.category_id')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
</div> --}}

                        </div>
                        <div class="py-5">
                            <div class="border border-gray-200 rounded-lg px-2 py-2">
                                <div class="flex justify-start items-center font-bold">
                                    <x-label value="Documento (Opcional) para detalles de la ofertaLaboral"
                                        class="font-bold" />
                                </div>
                                <input class="w-full" type="file" wire:model="documentoOferta" />
                                @if (!empty($ofertaLaboral['documentos_oferta']))
                                    <div class="flex flex-row border rounded-lg mt-2">
                                        <div class="bg-gray-200 px-1 pt-1 py-3 rounded-l-lg">
                                            <img src="/img/pdf-logo.png" alt="">
                                        </div>
                                        <div class="flex justify-center items-start flex-col px-4">
                                            <div>
                                                {{ strlen($ofertaLaboral['documentos_oferta']) > 30 ? substr($ofertaLaboral['documentos_oferta'], 0, 30) . '...' : $ofertaLaboral['documentos_oferta'] }}
                                            </div>
                                            <div class="flex flex-row gap-5">
                                                <div>
                                                    <a href="#"
                                                        class=" text-gray-600 text-sm hover:text-blue-400 "
                                                        id="visualizarDocumentoOferta">Visualizar</a>
                                                </div>
                                                <div>
                                                    <!-- Enlace para descargar el documento -->
                                                    <a href="{{ asset('storage/' . $ofertaLaboral['documentos_oferta']) }}"
                                                        class=" text-gray-600 text-sm hover:text-blue-400 "
                                                        download="{{ $ofertaLaboral['empresa']['ra_social'] }}">
                                                        Descargar Archivo
                                                    </a>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                @else
                                    <samp></samp>
                                @endif
                                <x-input-error for="documentoOferta" /> <!-- Mostrar error para documentoOferta -->
                            </div>
                        </div>
                        <input hidden wire:model="ofertaLaboral.user" />
                    </div>
                    <input hidden wire:model="ofertaLaboral.user_id" />

                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-button-danger wire:click="$set('isOpen',false)">Cancelar</x-button-danger>
            <x-button-success wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store, image"
                class="disabled:opacity-25">
                @if ($ruteCreate)
                    Registrar
                @else
                    Actualizar
                @endif
            </x-button-success>
        </x-slot>
    </x-dialog-modal>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    <script>
        // Agregar un evento click al enlace "Visualizar" solo si existe en el DOM
        const visualizarDocumentoLink = document.getElementById('visualizarDocumentoOferta');
        if (visualizarDocumentoLink) {
            visualizarDocumentoLink.addEventListener('click', function(event) {
                event.preventDefault(); // Prevenir el comportamiento predeterminado del enlace

                // URL del documento

                var url = "{{ asset('storage/' . (isset($ofertaLaboral['documentos_oferta']) ? $ofertaLaboral['documentos_oferta'] : 'default-file.pdf')) }}";
                // Cargar el documento PDF
                pdfjsLib.getDocument(url).promise.then(function(pdf) {
                    var totalPages = pdf.numPages; // Obtener el número total de páginas del documento

                    // Limpiar el contenido existente en el visor
                    var viewer = document.getElementById('viewer');
                    viewer.innerHTML = '';

                    // Renderizar todas las páginas del PDF
                    for (var pageNumber = 1; pageNumber <= totalPages; pageNumber++) {
                        pdf.getPage(pageNumber).then(function(page) {
                            // Configurar el visor
                            var scale = 1.5;
                            var viewport = page.getViewport({
                                scale: scale
                            });

                            // Preparar el lienzo para mostrar la página
                            var canvas = document.createElement('canvas');
                            var context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            // Renderizar la página en el lienzo
                            var renderContext = {
                                canvasContext: context,
                                viewport: viewport
                            };
                            page.render(renderContext);

                            // Mostrar el lienzo en el modal
                            viewer.appendChild(canvas);
                        }).catch(function(error) {
                            console.error('Error al renderizar la página:', error);
                        });
                    }

                    // Mostrar el modal después de cargar el documento con éxito
                    document.getElementById('modalDocumentoOferta').classList.remove('hidden');
                }).catch(function(error) {
                    console.error('Error al cargar el documento PDF:', error);
                });
            });
        }

        // Agregar evento clic al botón de cierre del modal
        const closeModalButton = document.querySelector('[data-bs-dismiss="modal"]');
        if (closeModalButton) {
            closeModalButton.addEventListener('click', function() {
                document.getElementById('modalDocumentoOferta').classList.add('hidden');
            });
        }

        // Agregar evento clic al fondo oscuro para cerrar el modal
        const modalBackground = document.getElementById('modalBackground');
        if (modalBackground) {
            modalBackground.addEventListener('click', function() {
                document.getElementById('modalDocumentoOferta').classList.add('hidden');
            });
        }
    </script>

</div>
