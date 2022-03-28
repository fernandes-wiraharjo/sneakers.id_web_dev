<a class="PageSkipLink u-visually-hidden" href="#main">Skip to content</a>
<span class="LoadingBar"></span>
<div class="PageOverlay"></div>
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
                                </div>
                            </div>
                        </div>
                        <div class="Collapsible">
                            <button class="Collapsible__Button_ Collapsible__Button Heading u-h6"
                                data-action="toggle-collapsible" aria-expanded="false">MEN'S<span
                                    class="Collapsible__Plus"></span></button>
                            <div class="Collapsible__Inner">
                                <div class="Collapsible__Content">
                                    <div class="Collapsible"><a href="{{ route('collections', 'all.MENS') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">ALL</a>
                                    </div>
                                    <div class="Collapsible"><a
                                            href="{{ route('collections', 'new-release.MENS') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">NEW
                                            RELEASES</a></div>
                                    <div class="Collapsible"><a
                                            href="{{ route('collections', 'best-seller.MENS') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">BEST
                                            SELLERS</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="Collapsible">
                            <button class="Collapsible__Button_ Collapsible__Button Heading u-h6"
                                data-action="toggle-collapsible" aria-expanded="false">WOMAN'S<span
                                    class="Collapsible__Plus"></span></button>
                            <div class="Collapsible__Inner">
                                <div class="Collapsible__Content">
                                    <div class="Collapsible"><a href="{{ route('collections', 'all.WOMANS') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">ALL</a>
                                    </div>
                                    <div class="Collapsible"><a
                                            href="{{ route('collections', 'new-release.WOMANS') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">NEW
                                            RELEASES</a></div>
                                    <div class="Collapsible"><a
                                            href="{{ route('collections', 'best-seller.WOMANS') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">BEST
                                            SELLERS</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="Collapsible">
                            <button class="Collapsible__Button_ Collapsible__Button Heading u-h6"
                                data-action="toggle-collapsible" aria-expanded="false">KIDS'<span
                                    class="Collapsible__Plus"></span></button>
                            <div class="Collapsible__Inner">
                                <div class="Collapsible__Content">
                                    <div class="Collapsible"><a href="{{ route('collections', 'all.KIDS') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">ALL</a>
                                    </div>
                                    <div class="Collapsible"><a
                                            href="{{ route('collections', 'new-release.KIDS') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">NEW
                                            RELEASES</a></div>
                                    <div class="Collapsible"><a
                                            href="{{ route('collections', 'best-seller.KIDS') }}"
                                            class="Collapsible__Button Heading Text--subdued Link Link--primary u-h7">BEST
                                            SELLERS</a></div>
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
                        <li class="HorizontalList__Item">
                            <a href="{{ route('lookbook', 1) }}" class="Heading u-h6">LOOKBOOK<span
                                    class="Header__LinkSpacer">LOOKBOOK</span></a>
                        </li>
                        <li class="HorizontalList__Item">
                            <a href="{{ route('size-chart') }}" class="Heading u-h6">SIZE CHART<span
                                    class="Header__LinkSpacer">SIZE CHART</span></a>
                        </li>
                    </nav>
                    <nav class="SidebarMenu__Nav SidebarMenu__Nav--secondary">
                        <ul class="Linklist Linklist--spacingLoose">
                            <li class="Linklist__Item">
                                <a href="{{ route('login') }}" class="Text--subdued Link Link--primary">Login</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="PageContainer">
    <div id="shopify-section-header" class="shopify-section shopify-section--header">
        <div id="Search" class="Search" aria-hidden="true">
            <div class="Search__Inner">
                <div class="Search__SearchBar">
                    <form action="{{ route('search') }}" class="Search__Form">
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

                        <input type="text" class="Search__Input Heading" name="q" autocomplete="off" autocorrect="off"
                            autocapitalize="off" placeholder="Search..." autofocus />

                        {{-- <button class="Button Button--primary" style="margin-right: 20px;" type="submit"> search </button> --}}
                    </form>

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
                                    </ul>
                                </div>
                            </li>
                            <li class="HorizontalList__Item" aria-haspopup="true">
                                <a href="{{ route('collections', 'all.MEN') }}"
                                    class="Heading u-h6 main-heading-text">MEN'S<span
                                        class="Header__LinkSpacer">MEN'S</span></a>
                                <div class="DropdownMenu" aria-hidden="true">
                                    <ul class="Linklist">
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'all.MENS') }}"
                                                class="Link Link--secondary">ALL </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'new-release.MENS') }}"
                                                class="Link Link--secondary">NEW RELEASES </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'best-seller.MENS') }}"
                                                class="Link Link--secondary">BEST SELLERS </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="HorizontalList__Item" aria-haspopup="true">
                                <a href="{{ route('collections', 'all.' . $item->brand_code) }}"
                                    class="Heading u-h6 main-heading-text">WOMEN'S<span
                                        class="Header__LinkSpacer">WOMEN'S</span></a>
                                <div class="DropdownMenu" aria-hidden="true">
                                    <ul class="Linklist">
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'all.WOMENS') }}"
                                                class="Link Link--secondary">ALL </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'new-release.WOMENS') }}"
                                                class="Link Link--secondary">NEW RELEASES </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'best-seller.WOMENS') }}"
                                                class="Link Link--secondary">BEST SELLERS </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="HorizontalList__Item" aria-haspopup="true">
                                <a href="{{ route('collections', 'all.' . $item->brand_code) }}"
                                    class="Heading u-h6 main-heading-text">KIDS'<span
                                        class="Header__LinkSpacer">KIDS'</span></a>
                                <div class="DropdownMenu" aria-hidden="true">
                                    <ul class="Linklist">
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'all.KIDS') }}"
                                                class="Link Link--secondary">ALL </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'new-release.KIDS') }}"
                                                class="Link Link--secondary">NEW RELEASES </a>
                                        </li>
                                        <li class="Linklist__Item">
                                            <a href="{{ route('collections', 'best-seller.KIDS') }}"
                                                class="Link Link--secondary">BEST SELLERS </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="HorizontalList__Item" aria-haspopup="true">
                                <a href="{{ route('collections', 'all') }}"
                                    class="Heading u-h6 main-heading-text">BRAND<span
                                        class="Header__LinkSpacer">BRAND</span></a>
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
                                <a href="{{ route('lookbook', 1) }}"
                                    class="Heading u-h6 main-heading-text">LOOKBOOK<span
                                        class="Header__LinkSpacer">LOOKBOOK</span></a>
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
                    <a href="{{ route('login') }}"
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
                </div>
            </div>
        </header>

        <style>
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

            :root {
                --header-is-not-transparent: 1;
                --header-is-transparent: 0;
            }

        </style>

        <script>
            document.documentElement.style.setProperty("--header-height", document.getElementById("shopify-section-header")
                .offsetHeight + "px");

        </script>
    </div>
</div>
