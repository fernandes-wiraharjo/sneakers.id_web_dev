<!-- Dropdown Backdrop -->
<div class="dropdown-backdrop" id="dropdownBackdrop" style="display: none;"></div>

<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <!-- Brand/Logo -->
        <a class="navbar-brand order-0 me-auto" href="{{ route('store') }}">
            <img src="{{ asset('stores-info/logo-black-new.png') }}" alt="SNEAKERS.ID">
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler border-0 order-2 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuOffcanvas" 
            aria-controls="mobileMenuOffcanvas" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse order-3 order-lg-1 d-none d-lg-block" id="navbarMain">
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
                    </ul>
                </li>

                <!-- SALE -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('collections', 'sale') }}">Sale</a>
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
                    <a href="javascript:void(0)" class="nav-link dropdown-toggle" onclick="toggleCustomDropdown('signature')">Signature Athlete</a>
                </li>

                <!-- BRAND Dropdown -->
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link dropdown-toggle" onclick="toggleCustomDropdown('brand')">Brand</a>
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
                <button class="d-flex align-items-center nav-link border-0 bg-transparent p-0" type="button" id="toggleSearchBtn" aria-label="Toggle search">
                    <span class="iconify" data-icon="material-symbols:search-rounded"></span>
                </button>
            </li>

            <!-- Cart -->
            <li class="nav-item">
                <button class="d-flex align-items-center nav-link position-relative border-0 bg-transparent p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">
                    <span class="iconify" data-icon="uil:cart"></span>
                    @livewire('cart-counter')
                </button>
            </li>
        </ul>
    </div>
</nav>

<!-- Brand dropdown -->
 <div class="container-fluid dropdown-menu bg-white border-0 shadow brandDropdownWrapper" style="display: none;">
    <div class="container py-3">
        <div class="row mb-4">
            <div class="col-12">
                <span class="fs-3 fw-bold text-uppercase">BRAND</span>
            </div>
        </div>
        <div class="d-flex flex-wrap gap-5 justify-content-evenly">
            @foreach ($brand_menu as $brand)
            <a href="{{ route('collections', 'all.' . $brand->brand_code) }}" class="d-flex flex-column p-2 justify-content-center align-items-center shadow-sm">
                <img src="{{ getImage($brand->brand_image, 'brand') }}" alt="{{ $brand->brand_title }}">
                <span>{{ strtoupper($brand->brand_title) }}</span>
            </a>
            @endforeach
        </div>
    </div>
 </div>

<!-- Signature Player dropdown -->
 <div class="container-fluid dropdown-menu bg-white border-0 shadow signatureDropdownWrapper" style="display: hidden;">
    <div class="container py-3">
        <div class="d-flex mb-4 justify-content-between align-items-center">
            <span class="fs-3 fw-bold text-uppercase">SIGNATURE ATHLETE</span>
            <a href="{{ url('signature-athlete') }}" class="d-flex align-items-center gap-2 text-decoration-none justify-content-end">
                <span>View All</span>
                <span class="iconify fs-3" data-icon="stash:arrow-right-duotone"></span>
            </a>
        </div>
        <div class="d-flex flex-wrap gap-3 justify-content-start">
            @foreach ($signature as $item)
            <a href="{{ route('collections', 'signatures.' . $item->signature_code) }}" class="position-relative signaturePlayerItem rounded">
                <img src="{{ $item->signature_image }}" alt="{{ $item->signature_title }}" class="signaturePlayerImage rounded" onerror="this.src='https://placehold.co/110x220/black/white?text=No+Image'">
                <div class="position-absolute w-100 mx-auto d-flex flex-column align-items-center" style="bottom: 5px;">
                    <img src="{{ $item->emblem_url }}" alt="{{ $item->signature_title }}" class="signaturePlayerEmblem" onerror="this.src='https://placehold.co/50x50/grey/white?text=No+Emblem'">
                    <span class="mt-2 text-center text-white signaturePlayerName"><?= str_replace(' ', '<br>', $item->signature_title) ?></span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
 </div>

<!-- Search Bar (Hidden by default) -->
<div class="container-fluid bg-white border-0 shadow" id="searchBar" style="display: none;">
    <div class="container py-3">
        <div class="d-flex align-items-center">
            <!-- Search Icon -->
            <div class="me-3" style="color: #939393;">
                <span class="iconify" data-icon="material-symbols:search-rounded" style="font-size: 21px;"></span>
            </div>
            
            <!-- Search Input -->
            <input type="text" 
                   class="form-control border-0 bg-transparent flex-grow-1" 
                   id="global_search" 
                   name="q" 
                   placeholder="Search..." 
                   autocomplete="off" 
                   autocorrect="off" 
                   autocapitalize="off"
                   style="font-size: 15px; box-shadow: none;"
                   aria-label="Search">
            
            <!-- Close Button -->
            <button class="btn btn-link text-decoration-none p-0 ms-3" type="button" id="closeSearchBtn" aria-label="Close search" style="color: #939393;">
                <span class="iconify" data-icon="mdi:close" style="font-size: 16px;"></span>
            </button>
        </div>
        
        <!-- Search Results Container -->
        <div id="searchResults" class="mt-3" style="display: none;">
            <div class="border-top pt-3">
                <div class="fw-semibold text-uppercase small mb-2" style="color: #666;">Products</div>
                <ul id="searchResultsList" class="list-unstyled mb-0"></ul>
                <div class="mt-2">
                    <a href="#" id="total_result" class="text-decoration-none fw-semibold small"></a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Dropdown backdrop */
    .dropdown-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1039;
    }
    
    /* Ensure navbar and dropdowns stay above backdrop */
    .navbar,
    .navbar .dropdown-menu,
    .brandDropdownWrapper,
    .signatureDropdownWrapper,
    #searchBar {
        position: relative;
        z-index: 1041;
    }
    
    /* Bootstrap default dropdown styling */
    .navbar-nav .dropdown-menu {
        border: none;
        border-radius: 0;
        padding: 1rem 0;
        z-index: 1041;
    }
    .navbar-nav .dropdown-menu .dropdown-item {
        padding: 0.75rem 5rem 0.75rem 1.5rem;
    }
    
    /* Custom dropdown styling */
    .brandDropdownWrapper a {
        width: 206px;
        height: 150px;
    }
    .brandDropdownWrapper a img {
        max-width: 110px;
        max-height: 110px;
    }
    .brandDropdownWrapper a:hover {
        border: 1px solid black;
        border-radius: 1rem;
    }
    .signatureDropdownWrapper .signaturePlayerImage {
        width: 115px;
        height: 230px;
        object-fit: cover;
    }
    .signatureDropdownWrapper .signaturePlayerItem:hover {
        box-shadow: 0 0 10px grey;
    }
    .signatureDropdownWrapper .signaturePlayerEmblem {
        width: 50px;
        height: 50px;
    }
</style>

@push('scripts')
<script>
    $(document).ready(function() {
        const toggleSearchBtn = $('#toggleSearchBtn');
        const searchBar = $('#searchBar');
        const globalSearch = $('#global_search');
        const closeSearchBtn = $('#closeSearchBtn');
        const searchResults = $('#searchResults');
        const searchResultsList = $('#searchResultsList');
        const totalResult = $('#total_result');

        // Toggle search bar visibility
        function toggleSearch() {
            if (searchBar.is(':visible')) {
                searchBar.slideUp(300, function() {
                    globalSearch.val('');
                    searchResults.hide();
                    searchResultsList.html('');
                    // Hide backdrop if no dropdowns are open
                    const hasOpenDropdown = $('.dropdown-menu.show').not('.brandDropdownWrapper, .signatureDropdownWrapper').length > 0;
                    const hasOpenCustomDropdown = $('.brandDropdownWrapper:visible, .signatureDropdownWrapper:visible').length > 0;
                    if (!hasOpenDropdown && !hasOpenCustomDropdown) {
                        hideBackdrop();
                    }
                });
            } else {
                searchBar.slideDown(300, function() {
                    globalSearch.focus();
                    showBackdrop();
                });
            }
        }

        // Open/close search
        toggleSearchBtn.on('click', function(e) {
            e.preventDefault();
            toggleSearch();
        });

        // Close search
        closeSearchBtn.on('click', function(e) {
            e.preventDefault();
            searchBar.slideUp(300, function() {
                globalSearch.val('');
                searchResults.hide();
                searchResultsList.html('');
                // Hide backdrop if no dropdowns are open
                const hasOpenDropdown = $('.dropdown-menu.show').not('.brandDropdownWrapper, .signatureDropdownWrapper').length > 0;
                const hasOpenCustomDropdown = $('.brandDropdownWrapper:visible, .signatureDropdownWrapper:visible').length > 0;
                if (!hasOpenDropdown && !hasOpenCustomDropdown) {
                    hideBackdrop();
                }
            });
        });

        // Search input handler - AJAX search
        globalSearch.on('input', function() {
            const searchQuery = $(this).val().trim();
            
            if (searchQuery.length > 0) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('search') }}',
                    data: {'search': searchQuery},
                    success: function(data) {
                        const result = JSON.parse(data);
                        const items = result.item;
                        let searchResultHtml = '';

                        if (items && items.length > 0) {
                            for (let index = 0; index < items.length; index++) {
                                const imageUrl = '{{ asset("images/") }}/products/' + items[index].product_code + '/' + items[index].image;
                                const productUrl = '/product-detail/' + items[index].id + '/' + items[index].product_name.replace(/ /g, '_');
                                
                                searchResultHtml += 
                                    '<li>' +
                                        '<a href="' + productUrl + '">' +
                                            '<img src="' + imageUrl + '" alt="' + items[index].product_name + '" class="search-result-image">' +
                                            '<div class="search-result-info">' +
                                                '<div class="fw-semibold">' + items[index].product_name + '</div>' +
                                            '</div>' +
                                        '</a>' +
                                    '</li>';
                            }
                            searchResults.show();
                            searchResultsList.html(searchResultHtml);
                            totalResult.html('View All ' + result.total_result + ' Products').attr('href', '/search-result/' + encodeURIComponent(searchQuery));
                        } else {
                            searchResultHtml = '<li class="text-muted">Search not found!</li>';
                            searchResults.show();
                            searchResultsList.html(searchResultHtml);
                            totalResult.html('').attr('href', '#');
                        }
                    },
                    error: function() {
                        searchResults.hide();
                        searchResultsList.html('');
                    }
                });
            } else {
                searchResults.hide();
                searchResultsList.html('');
                totalResult.html('').attr('href', '#');
            }
        });

        // Close search on Escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && searchBar.is(':visible')) {
                searchBar.slideUp(300, function() {
                    globalSearch.val('');
                    searchResults.hide();
                    searchResultsList.html('');
                    // Hide backdrop if no dropdowns are open
                    const hasOpenDropdown = $('.dropdown-menu.show').not('.brandDropdownWrapper, .signatureDropdownWrapper').length > 0;
                    const hasOpenCustomDropdown = $('.brandDropdownWrapper:visible, .signatureDropdownWrapper:visible').length > 0;
                    if (!hasOpenDropdown && !hasOpenCustomDropdown) {
                        hideBackdrop();
                    }
                });
            }
        });

        // Close search results when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#searchBar').length && searchBar.is(':visible')) {
                searchResults.hide();
            }
        });
    });

    // Show/hide backdrop
    function showBackdrop() {
        $('#dropdownBackdrop').css('display', 'block');
    }
    
    function hideBackdrop() {
        $('#dropdownBackdrop').css('display', 'none');
    }
    
    // Make toggleCustomDropdown globally available
    function toggleCustomDropdown(dropdownId) {
        console.log('toggleCustomDropdown called with:', dropdownId);
        
        // Hide search bar if open
        $('#searchBar').slideUp(300);
        
        // Hide all Bootstrap dropdown menus (removes 'show' class) - only target Bootstrap dropdowns, not custom ones
        $('.dropdown-menu').not('.brandDropdownWrapper, .signatureDropdownWrapper').removeClass('show');
        
        // Get the target dropdown by appending DropdownWrapper to dropdownId
        const targetDropdown = $('.' + dropdownId + 'DropdownWrapper');
        
        // Hide all custom dropdowns first
        $('.brandDropdownWrapper, .signatureDropdownWrapper').not(targetDropdown).slideUp(300);
        
        // Toggle the target dropdown
        if (targetDropdown.length) {
            if (targetDropdown.is(':visible')) {
                targetDropdown.slideUp(300);
                hideBackdrop();
            } else {
                targetDropdown.slideDown(300);
                showBackdrop();
            }
        }
    }
    
    // Handle Bootstrap dropdown events
    $(document).on('show.bs.dropdown', '.dropdown', function() {
        showBackdrop();
    });
    
    $(document).on('hide.bs.dropdown', '.dropdown', function() {
        // Check if any dropdown is still open
        setTimeout(function() {
            const hasOpenDropdown = $('.dropdown-menu.show').not('.brandDropdownWrapper, .signatureDropdownWrapper').length > 0;
            const hasOpenCustomDropdown = $('.brandDropdownWrapper:visible, .signatureDropdownWrapper:visible').length > 0;
            if (!hasOpenDropdown && !hasOpenCustomDropdown) {
                hideBackdrop();
            }
        }, 150);
    });
    
    // Close dropdowns when clicking backdrop
    $(document).on('click', '#dropdownBackdrop', function() {
        // Hide Bootstrap dropdowns
        $('.dropdown-menu').not('.brandDropdownWrapper, .signatureDropdownWrapper').removeClass('show');
        $('.dropdown').removeClass('show');
        
        // Hide custom dropdowns
        $('.brandDropdownWrapper, .signatureDropdownWrapper').slideUp(300);
        
        hideBackdrop();
    });
    
    // Close custom dropdowns when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.brandDropdownWrapper, .signatureDropdownWrapper').length && 
            !$(e.target).closest('[onclick*="toggleCustomDropdown"]').length &&
            !$(e.target).closest('.dropdown-toggle').length) {
            $('.brandDropdownWrapper, .signatureDropdownWrapper').slideUp(300);
            
            // Check if any dropdown is still open
            const hasOpenDropdown = $('.dropdown-menu.show').not('.brandDropdownWrapper, .signatureDropdownWrapper').length > 0;
            if (!hasOpenDropdown) {
                hideBackdrop();
            }
        }
    });
</script>
@endpush

<!-- Cart Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel" style="width: 400px;">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold" id="cartOffcanvasLabel">Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0 d-flex flex-column" style="height: calc(100vh - 73px);">
        <form action="{{ route('customer.cart') }}" method="POST" novalidate class="d-flex flex-column h-100">
            @csrf
            @livewire('cart-component')
        </form>
    </div>
</div>