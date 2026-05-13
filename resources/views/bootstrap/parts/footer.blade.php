<div class="container-fluid" id="footer">
    <div class="container text-white">
        <div class="row">
            <div class="col-12 col-md-3 pe-md-0">
                <img src="{{ $logo_footer }}" alt="Footer Logo" class="img-fluid">
                <p class="mt-5 fs-1">
                    SNEAKERS.ID
                </p>
                <p class="mb-0">{{ $footer->about ?? '' }}</p>
            </div>
            <div class="col-12 col-md-2 offset-md-1 d-flex flex-column justify-content-between">
                <div>
                    <p class="mt-5 fs-2">Contact</p>
                    @if (isset($footer->phone_number_1))
                        <p>Hotline: <a href="tel:{{ preg_replace('/\D+/', '', $footer->phone_number_1) }}">{{ $footer->phone_number_1 }}</a></p>
                    @endif
                    @if (isset($footer->email))
                        <p>Email: <a href="mailto:{{ $footer->email }}">{{ $footer->email }}</a></p>
                    @endif
                    @if (isset($footer->wa))
                        <p>Whatsapp: <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/\D+/', '', $footer->wa) }}">{{ $footer->wa }}</a></p>
                    @endif
                </div>

                <div>
                    <p class="mt-5 fs-2">Help</p>
                    <p><a href="{{ route('faq') }}">FAQ</a></p>
                    <p class="mb-0"><a href="{{ url('blog') }}">Blog</a></p>
                </div>
            </div>
            <div class="col-12 col-md-4 offset-md-2 d-flex flex-column justify-content-between">
                <div>
                    <p class="mt-5 fs-2">Developed by</p>
                    <p>
                        <a href="https://fernandesdev.com/" target="_blank">Fernandes Wiraharjo</a>
                    <p>
                        <a href="https://aldy-portofolio.vercel.app/" target="_blank">Aldy Satria Gumilar</a>
                    </p>
                    <p>
                        <a href="https://github.com/nikkoagustino" target="_blank">Nikko Agustino</a>
                    </p>
                </div>
                
                <div class="d-flex gap-4 flex-wrap mt-5">
                    @foreach ($brand_menu as $item)
                    <div class="footer-brand">
                        <img src="{{ getImage($item->brand_image, 'brand') }}" alt="{{ $item->brand_title }}" class="img-fluid rounded-circle">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row py-5">
            <div class="col-12 text-center">
            © Sneakers.id {{ date('Y') }}
            </div>
        </div>
    </div>
</div>
