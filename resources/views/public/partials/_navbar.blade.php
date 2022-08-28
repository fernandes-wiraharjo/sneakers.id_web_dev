<div id="kt_header" class="header align-items-around" data-kt-sticky="true" data-kt-sticky-name="header"
    data-kt-sticky-offset="{default: '200px', lg: '300px'}" style="background-color: black; animation-duration: 0.3s;">
    <!--begin::Container-->
    <div class=" container-fluid  d-flex align-items-center">
        <!--begin::Heaeder menu toggle-->
        <div class="d-flex topbar align-items-center d-lg-none ms-n2 me-3" title="Show aside menu">
            <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px"
                id="kt_header_menu_mobile_toggle">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs015.svg-->
                <span class="svg-icon svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                            fill="currentColor"></path>
                        <path opacity="0.3"
                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                            fill="currentColor"></path>
                    </svg></span>
                <!--end::Svg Icon-->
            </div>
        </div>
        <!--end::Heaeder menu toggle-->

        <!--begin::Header Logo-->
        <div class="header-logo me-5 me-md-10 flex-grow-1 flex-lg-grow-0 ms-5">
            <a href="/">
                @if (config('ladmin.logo'))
                    <img alt="Logo" src="{{ config('ladmin.logo') }}" class="logo-default h-100px">
                @endif
            </a>
        </div>
        <!--end::Header Logo-->

        <!--begin::Wrapper-->
        <div class="d-flex align-items-stretch justify-content-start flex-lg-grow-1">
            <!--begin::Navbar-->
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <!--begin::Menu wrapper-->
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
                    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
                    data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true"
                    data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    <!--begin::Menu-->
                    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
                        id="#kt_header_menu" data-kt-menu="true">
                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            class="menu-item menu-lg-down-accordion me-lg-1 text-primary"><span
                                class="menu-link py-3 menu-parent"><span
                                    class="menu-title text-white">FEATURED</span><span
                                    class="menu-arrow d-lg-none"></span></span>
                            <div
                                class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                <div class="menu-item"><a class="menu-link py-3"
                                        href="http://bkn-sadataasn.localtest/data-search"><span
                                            class="menu-icon"></span><span class="menu-title">ALL PRODUCTS</span></a>
                                </div>
                                <div class="menu-item"><a class="menu-link py-3" href="#"><span
                                            class="menu-icon"></span><span class="menu-title">NEW FEATURED</span></a>
                                </div>
                                <div class="menu-item"><a class="menu-link py-3" href="#"><span
                                            class="menu-icon"></span><span class="menu-title">NEW REALEASES</span></a>
                                </div>
                                <div class="menu-item"><a class="menu-link py-3" href="#"><span
                                            class="menu-icon"></span><span class="menu-title">BEST SELLERS</span></a>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            class="menu-item menu-lg-down-accordion me-lg-1 text-primary"><span
                                class="menu-link py-3 menu-parent"><span class="menu-title text-white">MEN'S</span><span
                                    class="menu-arrow d-lg-none"></span></span>
                            <div
                                class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                <div class="menu-item"><a class="menu-link py-3"
                                        href="http://bkn-sadataasn.localtest/data-dashboard"><span
                                            class="menu-icon"></span><span class="menu-title">ALL</span></a>
                                </div>
                                <div class="menu-item"><a class="menu-link py-3" href="#"><span
                                            class="menu-icon"></span><span class="menu-title">NEW RELEASES</span></a>
                                </div>
                                <div class="menu-item"><a class="menu-link py-3" href="#"><span
                                            class="menu-icon"></span><span class="menu-title">BEST SELLERS</span></a>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            class="menu-item menu-lg-down-accordion me-lg-1 text-primary"><span
                                class="menu-link py-3 menu-parent"><span
                                    class="menu-title text-white">WOMEN'S</span><span
                                    class="menu-arrow d-lg-none"></span></span>
                            <div
                                class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                <div class="menu-item"><a class="menu-link py-3"
                                        href="http://bkn-sadataasn.localtest/data-dashboard"><span
                                            class="menu-icon"></span><span class="menu-title">ALL</span></a>
                                </div>
                                <div class="menu-item"><a class="menu-link py-3" href="#"><span
                                            class="menu-icon"></span><span class="menu-title">NEW RELEASES</span></a>
                                </div>
                                <div class="menu-item"><a class="menu-link py-3" href="#"><span
                                            class="menu-icon"></span><span class="menu-title">BEST SELLERS</span></a>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            class="menu-item menu-lg-down-accordion me-lg-1 text-primary"><span
                                class="menu-link py-3 menu-parent"><span
                                    class="menu-title text-white">KID'S</span><span
                                    class="menu-arrow d-lg-none"></span></span>
                            <div
                                class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                <div class="menu-item"><a class="menu-link py-3"
                                        href="http://bkn-sadataasn.localtest/data-dashboard"><span
                                            class="menu-icon"></span><span class="menu-title">ALL</span></a>
                                </div>
                                <div class="menu-item"><a class="menu-link py-3" href="#"><span
                                            class="menu-icon"></span><span class="menu-title">NEW RELEASES</span></a>
                                </div>
                                <div class="menu-item"><a class="menu-link py-3" href="#"><span
                                            class="menu-icon"></span><span class="menu-title">BEST SELLERS</span></a>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            class="menu-item menu-lg-down-accordion me-lg-1 text-primary"><span
                                class="menu-link py-3 menu-parent"><span
                                    class="menu-title text-white">BRAND</span><span
                                    class="menu-arrow d-lg-none"></span></span>
                            <div
                                class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                @foreach ($brand_menu as $item)
                                    <div class="menu-item"><a class="menu-link py-3"
                                            href="{{ route('collections', 'all.' . $item->brand_code) }}"><span
                                                class="menu-icon"></span><span
                                                class="menu-title">{{ $item->brand_title }}</span></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Menu wrapper-->

            </div>
            <!--end::Navbar-->

        </div>
        <!--end::Wrapper-->

        <!--begin::Wrapper-->
        <div class="d-flex align-items-stretch justify-content-end flex-lg-grow-1">
            <!--begin::Navbar-->
            <div class="d-flex align-items-stretch" id="kt_header_nav_tool">
                <!--begin::Menu wrapper-->
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
                    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
                    data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true"
                    data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_tool'}">
                    <!--begin::Menu-->
                    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
                        id="#kt_header_menu" data-kt-menu="true">
                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            class="menu-item menu-lg-down-accordion me-lg-1 text-primary"><span
                                class="menu-link py-3 menu-parent">
                                <div class="btn btn-icon btn-custom btn-icon-muted w-35px h-35px w-md-40px h-md-40px">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                fill="currentColor"></rect>
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div><span class="menu-arrow d-lg-none"></span>
                            </span>
                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 p-2 w-lg-300px mr-5">
                                <form data-kt-search-element="form" class="w-100 position-relative" autocomplete="off">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 translate-middle-y ms-0">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Input-->
                                    <input type="text" class="search-input form-control form-control-flush ps-10" name="search" value="" placeholder="Search..." data-kt-search-element="input">
                                    <!--end::Input-->
                                    <!--begin::Spinner-->
                                    <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-1" data-kt-search-element="spinner">
                                        <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                                    </span>
                                    <!--end::Spinner-->
                                    <!--begin::Reset-->
                                    <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none" data-kt-search-element="clear">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <!--end::Reset-->
                                </form>
                            </div>
                        </div>

                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Menu wrapper-->
                <div class="align-self-center">
                    <a href="{{ route('login') }}">
                        <!--begin::Menu-->
                        <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch">
                            <div class="btn btn-icon w-30px h-30px w-md-40px h-md-40px">
                                <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs015.svg-->
                                <span class="svg-icon svg-icon-2x"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"></path>
                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                                </svg></span>
                            <!--end::Svg Icon-->
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!--end::Navbar-->

        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
