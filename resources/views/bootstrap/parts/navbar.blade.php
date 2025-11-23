<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <!-- Brand/Logo -->
        <a class="navbar-brand order-0 me-auto" href="{{ route('store') }}">
            <img src="{{ asset('stores-info/logos-black.png') }}" alt="SNEAKERS.ID" height="50">
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
                        FEATURED
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarFeatured">
                        <li><a class="dropdown-item" href="{{ route('collections', 'all') }}">ALL PRODUCTS</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'featured') }}">FEATURED</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'new-release') }}">NEW RELEASES</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'best-seller') }}">BEST SELLERS</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'sale') }}">SALE</a></li>
                    </ul>
                </li>

                <!-- MEN'S Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('collections', 'all.MENS') }}" id="navbarMens" 
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        MEN'S
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarMens">
                        <li><a class="dropdown-item" href="{{ route('collections', 'all.MENS') }}">ALL PRODUCTS</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'basketball-shoes.MENS') }}">BASKETBALL SHOES</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'casual-sneakers.MENS') }}">CASUAL SNEAKERS</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'apparels.MENS') }}">APPARELS</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'accesories.MENS') }}">ACCESSORIES</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'sale.MENS') }}">SALE</a></li>
                    </ul>
                </li>

                <!-- WOMEN'S Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('collections', 'all.WOMENS') }}" id="navbarWomens" 
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        WOMEN'S
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarWomens">
                        <li><a class="dropdown-item" href="{{ route('collections', 'all.WOMENS') }}">ALL PRODUCTS</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'basketball-shoes.WOMENS') }}">BASKETBALL SHOES</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'casual-sneakers.WOMENS') }}">CASUAL SNEAKERS</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'apparels.WOMENS') }}">APPARELS</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'accesories.WOMENS') }}">ACCESSORIES</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'sale.WOMENS') }}">SALE</a></li>
                    </ul>
                </li>

                <!-- KIDS' Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('collections', 'all.KIDS') }}" id="navbarKids" 
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        KIDS'
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarKids">
                        <li><a class="dropdown-item" href="{{ route('collections', 'all.KIDS') }}">ALL PRODUCTS</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'basketball-shoes.KIDS') }}">BASKETBALL SHOES</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'casual-sneakers.KIDS') }}">CASUAL SNEAKERS</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'apparels.KIDS') }}">APPARELS</a></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'accesories.KIDS') }}">ACCESSORIES</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('collections', 'sale.KIDS') }}">SALE</a></li>
                    </ul>
                </li>

                <!-- BRAND Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('collections', 'all') }}" id="navbarBrand" 
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        BRAND
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarBrand">
                        @foreach ($brand_menu as $item)
                            <li><a class="dropdown-item" href="{{ route('collections', 'all.' . $item->brand_code) }}">{{ strtoupper($item->brand_title) }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <!-- PRE OWNED -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('collections', 'all.PREOWNED') }}">PRE OWNED</a>
                </li>

                <!-- SIZE CHART -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('size-chart') }}">SIZE CHART</a>
                </li>
            </ul>
        </div>

        <!-- Right Side Icons -->
        <ul class="navbar-nav ms-lg-auto fs-3 d-flex flex-row gap-1 order-1 order-lg-2">
            <!-- User Account -->
            @if(auth()->check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarAccount" 
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="iconify" data-icon="majesticons:user-line"></span>
                        {{ auth()->user()->name }}
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