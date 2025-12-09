<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <!-- Brand/Logo -->
        <a class="navbar-brand order-0 me-auto" href="{{ route('store') }}">
            <img src="{{ asset('stores-info/logo-black-new.png') }}" alt="SNEAKERS.ID">
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler border-0 order-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" 
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse order-3 order-lg-1" id="navbarMain">
            <!-- Main Navigation -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <!-- FEATURED Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('collections', 'all') }}" id="navbarFeatured" 
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Featured
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarFeatured">
                        <li><a class="dropdown-item" href="{{ route('collections', 'all') }}">All Products</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'featured') }}">Featured</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'new-release') }}">New releases</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'best-seller') }}">Best Sellers</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'sale') }}">Sale</a></li>
                    </ul>
                </li>

                <!-- MEN'S Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('collections', 'all.MENS') }}" id="navbarMens" 
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Men's
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarMens">
                        <li><a class="dropdown-item" href="{{ route('collections', 'all.MENS') }}">All Products</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'basketball-shoes.MENS') }}">Basketball Shoes</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'casual-sneakers.MENS') }}">Casual Sneakers</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'apparels.MENS') }}">Apparels</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'accesories.MENS') }}">Accesories</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'sale.MENS') }}">Sale</a></li>
                    </ul>
                </li>

                <!-- WOMEN'S Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('collections', 'all.WOMENS') }}" id="navbarWomens" 
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Women's
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarWomens">
                        <li><a class="dropdown-item" href="{{ route('collections', 'all.WOMENS') }}">All Products</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'basketball-shoes.WOMENS') }}">Basketball Shoes</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'casual-sneakers.WOMENS') }}">Casual Sneakers</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'apparels.WOMENS') }}">Apparels</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'accesories.WOMENS') }}">Accesories</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'sale.WOMENS') }}">Sale</a></li>
                    </ul>
                </li>

                <!-- KIDS' Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('collections', 'all.KIDS') }}" id="navbarKids" 
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kids'
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarKids">
                        <li><a class="dropdown-item" href="{{ route('collections', 'all.KIDS') }}">All Products</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'basketball-shoes.KIDS') }}">Basketball Shoes</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'casual-sneakers.KIDS') }}">Casual Sneakers</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'apparels.KIDS') }}">Apparels</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'accesories.KIDS') }}">Accesories</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'sale.KIDS') }}">Sale</a></li>
                    </ul>
                </li>

                <!-- Signature Player -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('collections', 'all') }}" id="navbarSignaturePlayer" 
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Signature Athlete
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarSignaturePlayer">
                        @foreach ($signature as $item)
                            <li><a class="dropdown-item" href="{{ route('collections', 'signatures.' . $item->id) }}">{{ $item->signature_title }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <!-- BRAND Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('collections', 'all') }}" id="navbarBrand" 
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Brand
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarBrand">
                        @foreach ($brand_menu as $item)
                            <li><a class="dropdown-item" href="{{ route('collections', 'all.' . $item->brand_code) }}">{{ strtoupper($item->brand_title) }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <!-- PRE OWNED -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('collections', 'all.PREOWNED') }}">Pre Owned</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('blog') }}">Blog</a>
                </li>

                <!-- SIZE CHART -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('size-chart') }}">SIZE CHART</a>
                </li> -->
            </ul>
        </div>

        <!-- Right Side Icons -->
        <ul class="navbar-nav ms-lg-auto fs-3 d-flex flex-row gap-1 align-items-center order-1 order-lg-2">
            <!-- User Account -->
            @if(auth()->check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fs-6" href="#" id="navbarAccount" 
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="iconify fs-3" data-icon="majesticons:user-line"></span>
                        <span class="fs-6">
                            {{ auth()->user()->name }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarAccount">
                        <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}">MY ACCOUNT</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="document.getElementById('ladmin-logout').submit()">
                                SIGN OUT
                            </a>
                            <form action="{{ route('administrator.logout') }}" id="ladmin-logout" method="post" class="d-none">@csrf</form>
                        </li>
                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('customer.login') }}">
                        <span class="iconify" data-icon="majesticons:user-line"></span>
                    </a>
                </li>
            @endif

            <!-- Search -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('search') }}">
                    <span class="iconify" data-icon="material-symbols:search-rounded"></span>
                </a>
            </li>

            <!-- Cart -->
            <li class="nav-item">
                <a class="nav-link position-relative" href="javascript:void(0);">
                    <span class="iconify" data-icon="uil:cart"></span>
                    @livewire('cart-counter')
                </a>
            </li>
        </ul>
    </div>
</nav>