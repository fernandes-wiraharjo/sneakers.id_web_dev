<a class="PageSkipLink u-visually-hidden" href="#main">Skip to content</a>
<span class="LoadingBar"></span>
<div id="main-overlay" class="PageOverlay"></div>
<div class="PageTransition"></div>

<div id="shopify-section-popup" class="shopify-section"></div>
<div id="shopify-section-sidebar-menu" class="shopify-section">
    <section id="sidebar-menu" class="SidebarMenu Drawer Drawer--small Drawer--fromLeft" aria-hidden="true"
        data-section-id="sidebar-menu" data-section-type="sidebar-menu">
        <header class="Drawer__Header" data-drawer-animated-left>
            <button class="Drawer__Close Icon-Wrapper--clickable" data-action="close-drawer"
                data-drawer-id="sidebar-menu" aria-label="Close navigation">
                <svg class="Icon Icon--close" role="presentation" viewBox="0 0 16 14">
                    <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd"></path>
                </svg>
            </button>
        </header>

        <div class="Drawer__Content">
            <div class="Drawer__Main" data-drawer-animated-left data-scrollable>
                <div class="Drawer__Container">
                    <nav class="SidebarMenu__Nav SidebarMenu__Nav--primary" aria-label="Sidebar navigation">
                        <div class="Collapsible">
                            <button class="Collapsible__Button_ Collapsible__Button Heading u-h6"
                                data-action="toggle-collapsible" aria-expanded="false">FEATURED<span
                                    class="Collapsible__Plus"></span></button>
                            <div class="Collapsible__Inner">
                                <div class="Collapsible__Content">
                                    <div class="Collapsible"><a href="{{ route('collections', 'all') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">ALL
                                            PRODUCTS</a></div>
                                    <div class="Collapsible"><a href="{{ route('collections', 'featured') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">NEW
                                            FEATURED</a></div>
                                    <div class="Collapsible"><a href="{{ route('collections', 'new-release') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">NEW
                                            RELEASES</a></div>
                                    <div class="Collapsible"><a href="{{ route('collections', 'best-seller') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">BEST
                                            SELLERS</a></div>
                                    <div class="Collapsible"><a href="{{ route('collections', 'sale') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">SALE</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="Collapsible">
                            <button class="Collapsible__Button_ Collapsible__Button Heading u-h6"
                                data-action="toggle-collapsible" aria-expanded="false">MEN'S<span
                                    class="Collapsible__Plus"></span></button>
                            <div class="Collapsible__Inner">
                                <div class="Collapsible__Content">
                                    <div class="Collapsible">
                                        <a href="{{ route('collections', 'all.MENS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                            ALL PRODUCTS
                                        </a>
                                    </div>
                                    <div class="Collapsible">
                                        <a href="{{ route('collections', 'basketball-shoes.MENS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                            BASKETBALL SHOES
                                        </a>
                                    </div>
                                    <div class="Collapsible">
                                        <a href="{{ route('collections', 'casual-sneakers.MENS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                            CASUAL SNEAKERS
                                        </a>
                                    </div>
                                    <div class="Collapsible">
                                        <a href="{{ route('collections', 'apparels.MENS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                            APPARELS
                                        </a>
                                    </div>
                                    <div class="Collapsible">
                                        <a href="{{ route('collections', 'accesories.MENS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                            ACCESSORIES
                                        </a>
                                    </div>
                                    <div class="Collapsible">
                                        <a href="{{ route('collections', 'sale.MENS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                            SALE
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="Collapsible">
                            <button class="Collapsible__Button_ Collapsible__Button Heading u-h6"
                                data-action="toggle-collapsible" aria-expanded="false">WOMEN'S<span
                                    class="Collapsible__Plus"></span></button>
                            <div class="Collapsible__Inner">
                                <div class="Collapsible__Content">
                                    <div class="Collapsible__Content">
                                        <div class="Collapsible">
                                            <a href="{{ route('collections', 'all.WOMENS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                                ALL PRODUCTS
                                            </a>
                                        </div>
                                        <div class="Collapsible">
                                            <a href="{{ route('collections', 'basketball-shoes.WOMENS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                                BASKETBALL SHOES
                                            </a>
                                        </div>
                                        <div class="Collapsible">
                                            <a href="{{ route('collections', 'casual-sneakers.WOMENS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                                CASUAL SNEAKERS
                                            </a>
                                        </div>
                                        <div class="Collapsible">
                                            <a href="{{ route('collections', 'apparels.WOMENS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                                APPARELS
                                            </a>
                                        </div>
                                        <div class="Collapsible">
                                            <a href="{{ route('collections', 'accesories.WOMENS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                                ACCESSORIES
                                            </a>
                                        </div>
                                        <div class="Collapsible">
                                            <a href="{{ route('collections', 'sale.WOMENS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                                SALE
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Collapsible">
                            <button class="Collapsible__Button_ Collapsible__Button Heading u-h6"
                                data-action="toggle-collapsible" aria-expanded="false">KIDS'<span
                                    class="Collapsible__Plus"></span></button>
                            <div class="Collapsible__Inner">
                                <div class="Collapsible__Content">
                                    <div class="Collapsible">
                                        <a href="{{ route('collections', 'all.KIDS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                            ALL PRODUCTS
                                        </a>
                                    </div>
                                    <div class="Collapsible">
                                        <a href="{{ route('collections', 'basketball-shoes.KIDS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                            BASKETBALL SHOES
                                        </a>
                                    </div>
                                    <div class="Collapsible">
                                        <a href="{{ route('collections', 'casual-sneakers.KIDS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                            CASUAL SNEAKERS
                                        </a>
                                    </div>
                                    <div class="Collapsible">
                                        <a href="{{ route('collections', 'apparels.KIDS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                            APPARELS
                                        </a>
                                    </div>
                                    <div class="Collapsible">
                                        <a href="{{ route('collections', 'accesories.KIDS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                            ACCESSORIES
                                        </a>
                                    </div>
                                    <div class="Collapsible">
                                        <a href="{{ route('collections', 'sale.KIDS') }}" class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">
                                            SALE
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Collapsible">
                            <button class="Collapsible__Button_ Collapsible__Button Heading u-h6"
                                data-action="toggle-collapsible" aria-expanded="false">BRAND<span
                                    class="Collapsible__Plus"></span></button>
                            <div class="Collapsible__Inner">
                                <div class="Collapsible__Content">
                                    @foreach ($brand_menu as $item)
                                        <div class="Collapsible"><a
                                                href="{{ route('collections', 'all.' . $item->brand_code) }}"
                                                class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">{{ $item->brand_title }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- <div class="Collapsible">
                            <a href="{{ route('lookbook', 1) }}" class="Collapsible__Button Heading Link Link--primary u-h6">LOOKBOOK<span
                                        class="Header__LinkSpacer">LOOKBOOK</span></a>
                        </div> --}}
                        <div class="Collapsible">
                            <a href="{{ route('collections', 'all.PREOWNED') }}" class="Collapsible__Button Heading Link Link--primary u-h6">PRE OWNED<span
                                        class="Header__LinkSpacer">PRE
                                        OWNED</span></a>
                        </div>
                        <div class="Collapsible">
                            <a href="{{ route('size-chart') }}" class="Collapsible__Button Heading Link Link--primary u-h6">SIZE CHART<span
                                        class="Header__LinkSpacer">SIZE CHART</span></a>
                        </div>
                    </nav>

                    @if(auth()->check())
                    <nav class="SidebarMenu__Nav SidebarMenu__Nav--secondary">
                        <ul class="Linklist Linklist--spacingLoose">
                            {{-- <li class="Linklist__Item">
                                <a href="{{ route('customer.dashboard') }}"
                                class="Link Link--secondary">MY ACCOUNT </a>
                            </li> --}}
                            <li class="Linklist__Item">
                                <a href="javascript:void(0);" onclick="document.getElementById('ladmin-logout').submit()" class="Link Link--secondary">
                                    {{ __('Logout') }}
                                </a>
                                <form action="{{ route('administrator.logout') }}" id="ladmin-logout" method="post">@csrf</form>
                            </li>
                        </ul>
                    </nav>
                    @else
                    <nav class="SidebarMenu__Nav SidebarMenu__Nav--secondary">
                        <ul class="Linklist Linklist--spacingLoose">
                            <li class="Linklist__Item">
                                <a href="{{ route('customer.login') }}" class="Text--subdued Link Link--primary">Login</a>
                            </li>
                        </ul>
                    </nav>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@include('display-store.store-theme._partials._cart')
<div class="PageContainer">
    <div id="shopify-section-header" class="shopify-section shopify-section--header">
        <div id="Search" class="Search" aria-hidden="true">
            <div class="Search__Inner">
                <div class="Search__SearchBar">
                    {{-- <form action="{{ route('search') }}" class="Search__Form"> --}}
                        <div class="Search__InputIconWrapper">
                            <span class="hidden-tablet-and-up">
                                <svg class="Icon Icon--search" role="presentation" viewBox="0 0 18 17">
                                    <g transform="translate(1 1)" stroke="currentColor" fill="none" fill-rule="evenodd"
                                        stroke-linecap="square">
                                        <path d="M16 16l-5.0752-5.0752"></path>
                                        <circle cx="6.4" cy="6.4" r="6.4"></circle>
                                    </g>
                                </svg>
                            </span>
                            <span class="hidden-phone">
                                <svg class="Icon Icon--search-desktop" role="presentation" viewBox="0 0 21 21">
                                    <g transform="translate(1 1)" stroke="currentColor" stroke-width="2" fill="none"
                                        fill-rule="evenodd" stroke-linecap="square">
                                        <path d="M18 18l-5.7096-5.7096"></path>
                                        <circle cx="7.2" cy="7.2" r="7.2"></circle>
                                    </g>
                                </svg>
                            </span>
                        </div>

                        <input type="search" class="Search__Input Heading ui-autocomplete-input" name="q" autocomplete="off" autocorrect="off" autocapitalize="off" placeholder="Search..." autofocus="" id="global_search">

                    {{-- </form> --}}

                    <button class="Search__Close Link Link--primary" data-action="close-search">
                        <svg class="Icon Icon--close" role="presentation" viewBox="0 0 16 14">
                            <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <header id="section-header" class="Header Header--logoLeft Header--withIcons" data-section-id="header"
            data-section-type="header" data-section-settings='{
  "navigationStyle": "logoLeft",
  "hasTransparentHeader": false,
  "isSticky": true
}' role="banner">
            <div class="Header__Wrapper">
                <div class="Header__FlexItem Header__FlexItem--fill">
                    <button class="Header__Icon Icon-Wrapper Icon-Wrapper--clickable hidden-desk" aria-expanded="false"
                        data-action="open-drawer" data-drawer-id="sidebar-menu" aria-label="Open navigation">
                        <span class="hidden-tablet-and-up">
                            <svg class="Icon Icon--nav" role="presentation" viewBox="0 0 20 14">
                                <path d="M0 14v-1h20v1H0zm0-7.5h20v1H0v-1zM0 0h20v1H0V0z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <span class="hidden-phone">
                            <svg class="Icon Icon--nav-desktop" role="presentation" viewBox="0 0 24 16">
                                <path d="M0 15.985v-2h24v2H0zm0-9h24v2H0v-2zm0-7h24v2H0v-2z" fill="currentColor"></path>
                            </svg>
                        </span>
                    </button>
                    <nav class="Header__MainNav hidden-pocket hidden-lap" aria-label="Main navigation">
                        <ul class="HorizontalList HorizontalList--spacingExtraLoose">
                            <li class="HorizontalList__Item" aria-haspopup="true">
                                <a href="{{ route('collections', 'all') }}"
                                    class="Heading u-h6 main-heading-text">FEATURED</a>
                                <div class="DropdownMenu" aria-hidden="true">
                                    <ul class="Linklist">
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'all') }}"
                                                class="Link Link--secondary">ALL PRODUCTS</a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'featured') }}"
                                                class="Link Link--secondary">FEATURED </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'new-release') }}"
                                                class="Link Link--secondary">NEW RELEASES </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'best-seller') }}"
                                                class="Link Link--secondary">BEST SELLERS </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'sale') }}"
                                                class="Link Link--secondary">SALE </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="HorizontalList__Item" aria-haspopup="true">
                                <a href="{{ route('collections', 'all.MENS') }}"
                                    class="Heading u-h6 main-heading-text">MEN'S<span
                                        class="Header__LinkSpacer">MEN'S</span></a>
                                <div class="DropdownMenu" aria-hidden="true">
                                    <ul class="Linklist">
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'all.MENS') }}"
                                                class="Link Link--secondary">
                                                ALL PRODUCTS
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'basketball-shoes.MENS') }}"
                                                class="Link Link--secondary">
                                                BASKETBALL SHOES
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'casual-sneakers.MENS') }}"
                                                class="Link Link--secondary">
                                                CASUAL SNEAKERS
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'apparels.MENS') }}"
                                                class="Link Link--secondary">
                                                APPARELS
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'accesories.MENS') }}"
                                                class="Link Link--secondary">
                                                ACCESSORIES
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'sale.MENS') }}"
                                                class="Link Link--secondary">
                                                SALE
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="HorizontalList__Item" aria-haspopup="true">
                                <a href="{{ route('collections', 'all.WOMENS') }}"
                                    class="Heading u-h6 main-heading-text">WOMEN'S<span
                                        class="Header__LinkSpacer">WOMEN'S</span></a>
                                <div class="DropdownMenu" aria-hidden="true">
                                    <ul class="Linklist">
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'all.WOMENS') }}"
                                                class="Link Link--secondary">
                                                ALL PRODUCTS
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'basketball-shoes.WOMENS') }}"
                                                class="Link Link--secondary">
                                                BASKETBALL SHOES
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'casual-sneakers.WOMENS') }}"
                                                class="Link Link--secondary">
                                                CASUAL SNEAKERS
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'apparels.WOMENS') }}"
                                                class="Link Link--secondary">
                                                APPARELS
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'accesories.WOMENS') }}"
                                                class="Link Link--secondary">
                                                ACCESSORIES
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'sale.WOMENS') }}"
                                                class="Link Link--secondary">
                                                SALE
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="HorizontalList__Item" aria-haspopup="true">
                                <a href="{{ route('collections', 'all.KIDS') }}"
                                    class="Heading u-h6 main-heading-text">KIDS'<span
                                        class="Header__LinkSpacer">KIDS'</span></a>
                                <div class="DropdownMenu" aria-hidden="true">
                                    <ul class="Linklist">
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'all.KIDS') }}"
                                                class="Link Link--secondary">
                                                ALL PRODUCTS
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'basketball-shoes.KIDS') }}"
                                                class="Link Link--secondary">
                                                BASKETBALL SHOES
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'casual-sneakers.KIDS') }}"
                                                class="Link Link--secondary">
                                                CASUAL SNEAKERS
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'apparels.KIDS') }}"
                                                class="Link Link--secondary">
                                                APPARELS
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'accesories.KIDS') }}"
                                                class="Link Link--secondary">
                                                ACCESSORIES
                                            </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'sale.KIDS') }}"
                                                class="Link Link--secondary">
                                                SALE
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="HorizontalList__Item" aria-haspopup="true">
                                <a href="{{ route('collections', 'all') }}"
                                    class="Heading u-h6 main-heading-text">BRAND<span
                                        class="Header__LinkSpacer">BRAND</span>
                                </a>
                                <div class="DropdownMenu" aria-hidden="true">
                                    <ul class="Linklist">
                                        @foreach ($brand_menu as $item)
                                            <li class="Linklist__Item">
                                                <a href="{{ route('collections', 'all.' . $item->brand_code) }}"
                                                    class="Link Link--secondary">{{ strtoupper($item->brand_title) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li class="HorizontalList__Item">
                                <a href="{{ route('collections', 'all.PREOWNED') }}" class="Heading u-h6 main-heading-text">PRE
                                    OWNED<span class="Header__LinkSpacer">PRE OWNED</span></a>
                            </li>
                            <li class="HorizontalList__Item">
                                <a href="{{ route('size-chart') }}" class="Heading u-h6 main-heading-text">SIZE
                                    CHART<span class="Header__LinkSpacer">SIZE CHART</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="Header__FlexItem Header__FlexItem--logo">
                    <div class="Header__Logo">
                        <a href="/" class="Header__LogoLink">
                            @if (config('ladmin.logo'))
                                <img class="Header__LogoImage Header__LogoImage--primary"
                                    src="{{ config('ladmin.logo') }}"
                                    srcset="{{ config('ladmin.logo') }} 1x, {{ config('ladmin.logo') }} 2x"
                                    height="100px" width="auto" style="max-height: 90px !important;"
                                    alt="{{ config('app.name') }}" />
                            @endif
                        </a>
                    </div>
                </div>

                <div class="Header__FlexItem Header__FlexItem--fill">
                    @if(auth()->check())

                        <nav class="Header__MainNav hidden-phone account-info" aria-label="Main navigation">
                            <ul class="HorizontalList HorizontalList--spacingExtraLoose">
                                <li class="HorizontalList__Item" aria-haspopup="true">
                                    <a href="#" class="Heading u-h6 main-heading-text"> {{-- to history transaction --}}
                                        <span>{{ auth()->user()->name }}</span>
                                    </a>
                                    <div class="DropdownMenu" aria-hidden="true">
                                        <ul class="Linklist">
                                            <li class="Linklist__Item">
                                                <a href="{{ route('customer.dashboard') }}"
                                                class="Link Link--secondary">MY ACCOUNT </a>
                                            </li>
                                            {{-- <li class="Linklist__Item">
                                                <a href="#"
                                                class="Link Link--secondary">MY TRANSACTION </a>
                                            </li> --}}
                                            <li class="Linklist__Item">
                                                <a href="javascript:void(0);" onclick="document.getElementById('ladmin-logout').submit()" class="Link Link--secondary">
                                                    {{ __('SIGN OUT') }}
                                                </a>
                                                <form action="{{ route('administrator.logout') }}" id="ladmin-logout" method="post">@csrf</form>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>

                    @else
                    <a href="{{ route('customer.login') }}"
                    class="Header__Icon Icon-Wrapper Icon-Wrapper--clickable hidden-phone">
                        <svg class="Icon Icon--account" role="presentation" viewBox="0 0 20 20">
                            <g transform="translate(1 1)" stroke="currentColor" stroke-width="2" fill="none"
                                fill-rule="evenodd" stroke-linecap="square">
                                <path
                                    d="M0 18c0-4.5188182 3.663-8.18181818 8.18181818-8.18181818h1.63636364C14.337 9.81818182 18 13.4811818 18 18">
                                </path>
                                <circle cx="9" cy="4.90909091" r="4.90909091"></circle>
                            </g>
                        </svg>
                    </a>
                    @endif
                    <a href="/search" class="Header__Icon Icon-Wrapper Icon-Wrapper--clickable "
                        data-action="toggle-search" aria-label="Search">
                        <span class="hidden-tablet-and-up">
                            <svg class="Icon Icon--search" role="presentation"
                                viewBox="0 0 18 17">
                                <g transform="translate(1 1)" stroke="currentColor" fill="none" fill-rule="evenodd"
                                    stroke-linecap="square">
                                    <path d="M16 16l-5.0752-5.0752"></path>
                                    <circle cx="6.4" cy="6.4" r="6.4"></circle>
                                </g>
                            </svg>
                        </span>
                        <span class="hidden-phone">
                            <svg class="Icon Icon--search-desktop" role="presentation"
                                viewBox="0 0 21 21">
                                <g transform="translate(1 1)" stroke="currentColor" stroke-width="2" fill="none"
                                    fill-rule="evenodd" stroke-linecap="square">
                                    <path d="M18 18l-5.7096-5.7096"></path>
                                    <circle cx="7.2" cy="7.2" r="7.2"></circle>
                                </g>
                            </svg>
                        </span>
                    </a>
                    <a href="customer/cart" class="Header__Icon Icon-Wrapper Icon-Wrapper--clickable " data-action="open-drawer" data-drawer-id="sidebar-cart" aria-expanded="false" aria-label="Open cart">
                        <span class="hidden-tablet-and-up">
                            <svg class="Icon Icon--cart" role="presentation" viewBox="0 0 17 20">
                                <path d="M0 20V4.995l1 .006v.015l4-.002V4c0-2.484 1.274-4 3.5-4C10.518 0 12 1.48 12 4v1.012l5-.003v.985H1V19h15V6.005h1V20H0zM11 4.49C11 2.267 10.507 1 8.5 1 6.5 1 6 2.27 6 4.49V5l5-.002V4.49z" fill="currentColor">
                                </path>
                            </svg>
                        </span>
                        <span class="hidden-phone">
                            <svg class="Icon Icon--cart-desktop" role="presentation" viewBox="0 0 19 23">
                                <path d="M0 22.985V5.995L2 6v.03l17-.014v16.968H0zm17-15H2v13h15v-13zm-5-2.882c0-2.04-.493-3.203-2.5-3.203-2 0-2.5 1.164-2.5 3.203v.912H5V4.647C5 1.19 7.274 0 9.5 0 11.517 0 14 1.354 14 4.647v1.368h-2v-.912z" fill="currentColor">
                                </path>
                            </svg>
                        </span>
                        @livewire('cart-counter')
                    </a>
                </div>
            </div>
        </header>

        <style>
            .dropdown-account {
                position: fixed;
            }

            :root {
                --use-sticky-header: 1;
                --use-unsticky-header: 0;
            }

            .shopify-section--header {
                position: -webkit-sticky;
                position: sticky;
            }

            @media screen and (max-width: 640px) {
                .Header__LogoImage {
                    max-width: 150px;
                }
            }

            @media screen and (min-width: 640px) {
                .account-info {
                    position: relative !important;
                    margin: 30px;
                    padding: 20px 0px;
                    text-align-last: right;
                }
            }

            :root {
                --header-is-not-transparent: 1;
                --header-is-transparent: 0;
            }

        </style>

        <script>
            document.documentElement.style.setProperty("--header-height", document.getElementById("shopify-section-header")
                .offsetHeight + "px");

        </script>

        <script src="{{ asset('js/pages/cart.js') }}"></script>
    </div>
</div>
