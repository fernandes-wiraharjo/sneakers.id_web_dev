<div class="position-relative">
    <!--begin::Footer-->
<div class="footer py-4 {{ theme()->printHtmlClasses('footer', false) }}" id="kt_footer" style="width: -webkit-fill-available; background-color: black;">
    <div class="{{ theme()->printHtmlClasses('footer-container', false) }} d-flex flex-center flex-column-auto flex-md-row align-items-center justify-content-around">
        <div class="flex-column text-center">
                <h1 class="text-white">CONTACT US</h1>
                <div class="text-white">
                    @if (isset($footer->phone_number_1))
                        <p><strong>Hotline:</strong>
                            {{ $footer->phone_number_1 ?? '' }}{{ isset($footer->phone_number_2) ? ' / ' . ($footer->phone_number_2 ?? '') : '' }}
                        </p>
                    @endif
                    <p></p>
                    @if (isset($footer->email))
                        <p><strong>E-mail:</strong> {{ $footer->email ?? '' }}</p>
                    @endif
                    @if (isset($footer->address))
                        <p><strong>Address:</strong> {{ $footer->address ?? '' }}</p>
                    @endif
                    @if (isset($footer->wa))
                        <p><strong>Whatsapp:</strong> {{ $footer->wa ?? '' }}</p>
                    @endif
                    @if (isset($footer->line))
                        <p><strong>Line:</strong> {{ $footer->line ?? '' }}</p>
                    @endif
                </div>
                <!--begin::Menu-->
                <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1" style="display: inline-flex;">
                    @if (isset($footer->social_media))
                        @foreach ($footer->social_media as $item)
                            <a href="{{ $item->social_link ?? '' }}"
                                aria-label="{{ $item->social_name ?? '' }}"
                                class="btn btn-icon btn-bg-light me-5 rounded-circle">
                                <i class="fab fa-{{ $item->social_icon ?? 'circle' }} fs-4"></i>
                            </a>
                        @endforeach
                    @endif
                </ul>
                <!--end::Menu-->
        </div>

        <div class="flex-column">
            <div class="text-center">
                <h1 class="text-white">ABOUT US</h1>
                <p class="text-white">{{ $footer->about ?? '' }}</p>
            </div>
        </div>

        <div class="flex-column">
            <div class="text-center">
                <h1 class="text-white">HELP</h1>
                <a href="{{ route('faq') }}" class="text-white">FAQ</a>
                <br>
                <a href="{{ $footer->maps ?? '' }}" class="text-white">
                    OUR STORE
                </a>
            </div>
        </div>
    </div>
</div>
<!--end::Footer-->
<div class="footer py-4 {{ theme()->printHtmlClasses('footer', false) }}" id="kt_footer" style="width: -webkit-fill-available; background-color: black;">
    <div class="{{ theme()->printHtmlClasses('footer-container', false) }} d-flex flex-center flex-column-auto flex-md-row align-items-center justify-content-between">
        <div class="flex-column">
            <div class="text-dark order-2 order-md-1">
                <span class="text-muted fw-bold me-1">Hak Cipta &copy; {{ date('Y') }}</span>
                <a href="#" target="_blank"
                    class="text-gray-200 text-hover-primary">sneakers.id</a>
                <span class="text-white"> - Semua hak cipta dilindungi.</span>
            </div>
        </div>
    </div>
</div>

<!--end::Footer-->
<div class="footer py-4 {{ theme()->printHtmlClasses('footer', false) }}" id="kt_footer" style="width: -webkit-fill-available; background-color: black;">
    <div class="{{ theme()->printHtmlClasses('footer-container', false) }} d-flex flex-center flex-column-auto flex-md-row align-items-center justify-content-between">
        <div class="flex-column">
            <div class="text-dark order-2 order-md-1">
                <span class="text-muted fw-bold me-1">Developed by :</span>
            </div>
        </div>
        <div class="flex-column">
            <div class="text-white order-2 order-md-1">
                <a href="#">Fernandes Wiraharjo - 089693670282 -
                    fernandeswiraharjo@gmail.com </a>
            </div>
        </div>
        <div class="flex-column">
            <div class="text-white order-2 order-md-1">
                <a href="">Aldy Satria Gumilar - 089636022489 - aldy.satria07@gmail.com</a>
            </div>
        </div>
    </div>
</div>

</div>
