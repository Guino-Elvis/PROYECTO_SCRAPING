<!-- Footer-->
<footer class="px-6 py-2">
    <div class="text-sm">
        <div class="flex justify-between">
            <div class="">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>, made with <span class="text-danger">
                    <i class="fa-solid fa-heart text-red-600"></i>
                </span> by <a href="{{ !empty(config('variables.creatorUrl')) ? config('variables.creatorUrl') : '' }}"
                    target="_blank"
                    class="footer-link fw-medium">{{ !empty(config('variables.creatorName')) ? config('variables.creatorName') : '' }}</a>
            </div>
            <div class="hidden lg:inline-block">
                {{-- <a href="{{ config('variables.licenseUrl') ? config('variables.licenseUrl') : '#' }}"
                    class="footer-link me-3" target="_blank">License</a>
                <a href="{{ config('variables.moreThemes') ? config('variables.moreThemes') : '#' }}" target="_blank"
                    class="footer-link me-3">More Themes</a>
                <a href="{{ config('variables.documentation') ? config('variables.documentation') . '/laravel-introduction.html' : '#' }}"
                    target="_blank" class="footer-link me-3">Documentation</a>
                <a href="{{ config('variables.support') ? config('variables.support') : '#' }}" target="_blank"
                    class="footer-link d-none d-sm-inline-block">Support</a> --}}
            </div>
        </div>
    </div>
</footer>
<!--/ Footer-->
