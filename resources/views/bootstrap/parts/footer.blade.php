<div class="container-fluid" id="footer">
    <div class="container text-white">
        <div class="row">
            <div class="col-12 col-md-3 pe-md-0">
                <img src="{{ asset('stores-info/logo-white-new.png') }}" alt="Footer Logo" class="img-fluid">
                <p class="mt-5 fs-1">
                    SNEAKERS.ID
                </p>
                <p class="mb-0">Established in 2015, we are a small but passionate company dedicated to serve sneaker enthusiasts all over Indonesia. Our primary focus is to offer you the highest quality products at the lowest prices.</p>
            </div>
            <div class="col-12 col-md-2 offset-md-1 d-flex flex-column justify-content-between">
                <div>
                    <p class="mt-5 fs-2">Contact</p>
                    <p>Hotline: <a href="tel:6289617925925">+6289617925925</a></p>
                    <p>Email: <a href="mailto:help@sneakers.id">help@sneakers.id</a></p>
                    <p>Whatsapp: <a href="https://api.whatsapp.com/send?phone=6289617925925">+6289617925925</a></p>
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
                    <p>Fernandes Wiraharjo</p>
                    <p>Aldy Satria Gumilar</p>
                </div>
                
                <div class="d-flex gap-4 flex-wrap mt-5">
                    @foreach ($brand_menu as $item)
                    <a class="footer-brand" href="{{ route('collections', 'all.' . $item->brand_code) }}">
                        <img src="{{ getImage($item->brand_image, 'brand') }}" alt="{{ $item->brand_title }}" class="img-fluid rounded-circle">
                    </a>
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