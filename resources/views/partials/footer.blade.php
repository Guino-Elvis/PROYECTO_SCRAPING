<footer class="footer-section w-full h-auto bg-gradient-to-b md:p-20 p-10">
    <div class="footer-section-content">
        <div class="footer-cta pb-10 mb-10">
            <div class="footer-cta-content">
                <div class="fcc_01">
                    <div class="single-cta flex items-center">
                        <i class="fas fa-map-marker-alt text-orange-500"></i>
                        <div class="cta-text pl-4">
                            <h4 class="text-white md:text-lg text-sm font-semibold mb-1">{{ trans('footerl.Ubicación') }}
                            </h4>
                            <span class="text-gray-600">Jr. Artesanal MzA_Lt.13_Urb. APIRAJ Juliaca, Puno, Perú</span>
                        </div>
                    </div>
                </div>
                <div class="fcc_01 sm:justify-center">
                    <div class="single-cta flex items-center">
                        <i class="fas fa-phone text-orange-500"></i>
                        <div class="cta-text pl-4">
                            <h4 class="text-white md:text-lg text-sm font-semibold mb-1">{{ trans('footerl.Teléfono') }}
                            </h4>
                            <span class="text-gray-600">+51 981141413</span>
                        </div>
                    </div>
                </div>
                <div class="fcc_01 sm:justify-end">
                    <div class="single-cta flex items-center">
                        <i class="far fa-envelope-open text-orange-500"></i>
                        <div class="cta-text pl-4">
                            <h4 class="text-white md:text-lg text-sm font-semibold mb-1">
                                {{ trans('footerl.Correo electrónico') }}</h4>
                            <a href="mailto:ventas@BOLSALABORAL.com" class="text-gray-600">ventas@BOLSALABORAL.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_cta_02">
            <div>
                <div class="footer-widget">
                    <div class="flex items-center space-x-2 mb-4">
                        <a href="/">
                            <img class="block h-10 w-auto lg:hidden object-contain" src="/img/infotel_blanco.png"
                                alt="">
                            <img class="hidden h-12 w-auto lg:block object-contain" src="/img/infotel_blanco.png"
                                alt="">
                        </a>
                    </div>
                    <div class="footer-text">
                        <p>{{ trans('footerl.No te olvides de seguirnos en:') }}</p>
                    </div>
                    <div class="flex flex-wrap ">
                        <ul class="wrapper flex flex-wrap">
                            <a href="https://web.facebook.com/profile.php?id=100068943425177" class="icon facebook">
                                <span class="tooltip">Facebook</span>
                                <span><i class="fab fa-facebook-f"></i></span>
                            </a>
                            <a href="https://www.instagram.com/infotelbusiness.sac/" class="icon instagram">
                                <span class="tooltip">Instagram</span>
                                <span><i class="fab fa-instagram"></i></span>
                            </a>
                            <a href="https://pe.linkedin.com/in/daniel-pinto-yampara-5181b337" class="icon linkedin">
                                <span class="tooltip">Linkedin</span>
                                <span><i class="fab fa-linkedin"></i></span>
                            </a>
                        </ul>
                    </div>

                </div>
            </div>
            <div>
                <div class="footer-widget">
                    <div class="footer-widget-heading">
                        <h3 class="text-white text-lg font-semibold mb-4">{{ trans('footerl.Enlaces de interés') }}</h3>
                    </div>
                    <ul class="flex flex-col ">
                        <li>
                            <a href=""
                                class="text-gray-600 hover:text-orange-500">{{ trans('footerl.Productos') }}</a>
                        </li>
                        <li>
                            <a href=""
                                class="text-gray-600 hover:text-orange-500">{{ trans('footerl.Galería') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <div class="footer-maps-encuestranos">
                    {{-- <h3 class="lg:mb-5 md:mb-4 sm:mb-2 ">{{ trans('footerl.Pagar con') }}</h3> --}}
                </div>
                <div class="icon_pago">
                    <div class="bg-white px-1 rounded w-max">
                        <img class="h-8 w-12" src="/img/visa.png" alt="">
                    </div>
                    <img class="h-8 w-[3.5rem]" src="/img/mastercard.webp" alt="">
                    <img class="h-8 w-[3.5rem]" src="/img/paypal.webp" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="flex flex-wrap items-center justify-center">
            <div class="text-center">
                <div class="copyright-text">
                    <p class="text-gray-600 text-sm mb-0">Copyright &copy; 2024,
                        {{ trans('footerl.Todos los derechos reservados BOLSALABORAL') }}</p>
                </div>
            </div>
            <div class="flex ">
                <div class="footer-menu">
                    <ul class="flex ">
                        <li><a href="/terms-of-service" class="text-gray-600 hover:text-orange-500">Terms</a></li>
                        <li><a href="/privacy-policy" class="text-gray-600 hover:text-orange-500">Privacy</a></li>
                        <li><a href="/privacy-policy" class="text-gray-600 hover:text-orange-500">Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
