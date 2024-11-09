                        <!-- Modal -->
                        <div id="modalDocumentoOferta" class="fixed top-0 left-0 w-full h-full  z-50 hidden">
                            <div class="flex items-center justify-center">
                                <div class="absolute w-full h-full bg-gray-500 opacity-75" id="modalBackground"></div>
                                <div class="modal-dialog-oferta flex items-center justify-center z-50">
                                    <div class="modal-content bg-white  p-4 rounded-lg overflow-hidden">
                                        <div
                                            class="modal-header flex justify-between items-center border-b border-gray-200">
                                            <h5 class="modal-title">Vista previa del documento</h5>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                        <div class="modal-body-oferta overflow-auto max-h-96">
                                            <div id="viewer" style="height: auto;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <style>
                            .modal-dialog-oferta {
                                width: 90%;
                                /* Ajusta el ancho del modal según sea necesario */
                                max-width: 90rem;
                                /* Establece un ancho máximo para el modal */
                            }

                            .modal-body-oferta {
                                max-height: calc(100vh - 200px);
                                /* Establece la altura máxima del cuerpo del modal */
                            }
                        </style>
