<!-- Mobile Menu Offcanvas -->
<div class="offcanvas offcanvas-top" tabindex="-1" id="mobileMenuOffcanvas" aria-labelledby="mobileMenuOffcanvasLabel">
    <div class="offcanvas-header d-flex align-items-center justify-content-between p-3" id="mobileMenuHeader">
        <button type="button" class="btn btn-link text-decoration-none p-0 mobile-menu-back d-none text-dark" data-back="parent" id="mobileMenuBackBtn">
            <span class="iconify fs-4" data-icon="majesticons:arrow-left-line" style="color: black;"></span>
        </button>
        <h5 class="offcanvas-title fw-bold mb-0" id="mobileMenuOffcanvasLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" id="mobileMenuClose"></button>
    </div>
    <div class="offcanvas-body pt-0">
        <!-- Parent Menu -->
        <div id="mobileParentMenu" class="mobile-menu-level">
            <ul class="list-unstyled mb-0">
                <!-- FEATURED -->
                <li>
                    <a href="javascript:void(0)" class="d-flex align-items-center justify-content-between p-3 text-decoration-none text-dark mobile-menu-item" data-submenu="featured">
                        <span>Featured</span>
                        <span class="iconify" data-icon="majesticons:chevron-right-line"></span>
                    </a>
                </li>
                
                <!-- SALE -->
                <li>
                    <a href="{{ route('collections', 'sale') }}" class="d-block p-3 text-decoration-none text-dark mobile-menu-item">
                        <span>Sale</span>
                    </a>
                </li>
                
                <!-- MEN'S -->
                <li>
                    <a href="javascript:void(0)" class="d-flex align-items-center justify-content-between p-3 text-decoration-none text-dark mobile-menu-item" data-submenu="mens">
                        <span>Men's</span>
                        <span class="iconify" data-icon="majesticons:chevron-right-line"></span>
                    </a>
                </li>
                
                <!-- WOMEN'S -->
                <li>
                    <a href="javascript:void(0)" class="d-flex align-items-center justify-content-between p-3 text-decoration-none text-dark mobile-menu-item" data-submenu="womens">
                        <span>Women's</span>
                        <span class="iconify" data-icon="majesticons:chevron-right-line"></span>
                    </a>
                </li>
                
                <!-- KIDS' -->
                <li>
                    <a href="javascript:void(0)" class="d-flex align-items-center justify-content-between p-3 text-decoration-none text-dark mobile-menu-item" data-submenu="kids">
                        <span>Kids'</span>
                        <span class="iconify" data-icon="majesticons:chevron-right-line"></span>
                    </a>
                </li>
                
                <!-- SIGNATURE ATHLETE -->
                <li>
                    <a href="javascript:void(0)" class="d-flex align-items-center justify-content-between p-3 text-decoration-none text-dark mobile-menu-item" data-submenu="signature">
                        <span>Signature Athlete</span>
                        <span class="iconify" data-icon="majesticons:chevron-right-line"></span>
                    </a>
                </li>
                
                <!-- BRAND -->
                <li>
                    <a href="javascript:void(0)" class="d-flex align-items-center justify-content-between p-3 text-decoration-none text-dark mobile-menu-item" data-submenu="brand">
                        <span>Brand</span>
                        <span class="iconify" data-icon="majesticons:chevron-right-line"></span>
                    </a>
                </li>
                
                <!-- PRE OWNED -->
                <li>
                    <a href="{{ route('collections', 'all.PREOWNED') }}" class="d-block p-3 text-decoration-none text-dark mobile-menu-item">
                        <span>Pre Owned</span>
                    </a>
                </li>
                
                <!-- BLOG -->
                <li>
                    <a href="{{ url('blog') }}" class="d-block p-3 text-decoration-none text-dark mobile-menu-item">
                        <span>Blog</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Featured Submenu -->
        <div id="mobileSubmenuFeatured" class="mobile-menu-level" style="display: none;">
            <ul class="list-unstyled mb-0">
                <li><a href="{{ route('collections', 'all') }}" class="d-block p-3 text-decoration-none text-dark">All Products</a></li>
                <li><a href="{{ route('collections', 'featured') }}" class="d-block p-3 text-decoration-none text-dark">Featured</a></li>
                <li><a href="{{ route('collections', 'new-release') }}" class="d-block p-3 text-decoration-none text-dark">New releases</a></li>
                <li><a href="{{ route('collections', 'best-seller') }}" class="d-block p-3 text-decoration-none text-dark">Best Sellers</a></li>
            </ul>
        </div>
        
        <!-- Men's Submenu -->
        <div id="mobileSubmenuMens" class="mobile-menu-level" style="display: none;">
            <ul class="list-unstyled mb-0">
                <li><a href="{{ route('collections', 'all.MENS') }}" class="d-block p-3 text-decoration-none text-dark">All Products</a></li>
                <li><a href="{{ route('collections', 'basketball-shoes.MENS') }}" class="d-block p-3 text-decoration-none text-dark">Basketball Shoes</a></li>
                <li><a href="{{ route('collections', 'casual-sneakers.MENS') }}" class="d-block p-3 text-decoration-none text-dark">Casual Sneakers</a></li>
                <li><a href="{{ route('collections', 'apparels.MENS') }}" class="d-block p-3 text-decoration-none text-dark">Apparels</a></li>
                <li><a href="{{ route('collections', 'accesories.MENS') }}" class="d-block p-3 text-decoration-none text-dark">Accesories</a></li>
                <li><hr class="my-0"></li>
                <li><a href="{{ route('collections', 'sale.MENS') }}" class="d-block p-3 text-decoration-none text-dark">Sale</a></li>
            </ul>
        </div>
        
        <!-- Women's Submenu -->
        <div id="mobileSubmenuWomens" class="mobile-menu-level" style="display: none;">
            <ul class="list-unstyled mb-0">
                <li><a href="{{ route('collections', 'all.WOMENS') }}" class="d-block p-3 text-decoration-none text-dark">All Products</a></li>
                <li><a href="{{ route('collections', 'basketball-shoes.WOMENS') }}" class="d-block p-3 text-decoration-none text-dark">Basketball Shoes</a></li>
                <li><a href="{{ route('collections', 'casual-sneakers.WOMENS') }}" class="d-block p-3 text-decoration-none text-dark">Casual Sneakers</a></li>
                <li><a href="{{ route('collections', 'apparels.WOMENS') }}" class="d-block p-3 text-decoration-none text-dark">Apparels</a></li>
                <li><a href="{{ route('collections', 'accesories.WOMENS') }}" class="d-block p-3 text-decoration-none text-dark">Accesories</a></li>
                <li><hr class="my-0"></li>
                <li><a href="{{ route('collections', 'sale.WOMENS') }}" class="d-block p-3 text-decoration-none text-dark">Sale</a></li>
            </ul>
        </div>
        
        <!-- Kids' Submenu -->
        <div id="mobileSubmenuKids" class="mobile-menu-level" style="display: none;">
            <ul class="list-unstyled mb-0">
                <li><a href="{{ route('collections', 'all.KIDS') }}" class="d-block p-3 text-decoration-none text-dark">All Products</a></li>
                <li><a href="{{ route('collections', 'basketball-shoes.KIDS') }}" class="d-block p-3 text-decoration-none text-dark">Basketball Shoes</a></li>
                <li><a href="{{ route('collections', 'casual-sneakers.KIDS') }}" class="d-block p-3 text-decoration-none text-dark">Casual Sneakers</a></li>
                <li><a href="{{ route('collections', 'apparels.KIDS') }}" class="d-block p-3 text-decoration-none text-dark">Apparels</a></li>
                <li><a href="{{ route('collections', 'accesories.KIDS') }}" class="d-block p-3 text-decoration-none text-dark">Accesories</a></li>
                <li><hr class="my-0"></li>
                <li><a href="{{ route('collections', 'sale.KIDS') }}" class="d-block p-3 text-decoration-none text-dark">Sale</a></li>
            </ul>
        </div>
        
        <!-- Signature Athlete Submenu -->
        <div id="mobileSubmenuSignature" class="mobile-menu-level" style="display: none;">
            <div class="d-flex flex-wrap gap-3">
                @foreach ($signature as $item)
                <a href="{{ route('collections', 'signatures.' . $item->signature_code) }}" class="position-relative signaturePlayerItem rounded text-decoration-none" style="width: 110px;">
                    <img src="{{ $item->signature_image }}" alt="{{ $item->signature_title }}" class="signaturePlayerImage rounded w-100" style="height: 230px; object-fit: cover;" onerror="this.src='https://placehold.co/110x220/black/white?text=No+Image'">
                    <div class="position-absolute w-100 mx-auto d-flex flex-column align-items-center bg-signature-player-overlay">
                        <!-- <img src="{{ $item->emblem_url }}" alt="{{ $item->signature_title }}" class="signaturePlayerEmblem" style="width: 50px; height: 50px;" onerror="this.src='https://placehold.co/50x50/grey/white?text=No+Emblem'"> -->
                        <span class="mt-2 text-center text-white signaturePlayerName small"><?= str_replace(' ', '<br>', $item->signature_title) ?></span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        
        <!-- Brand Submenu -->
        <div id="mobileSubmenuBrand" class="mobile-menu-level" style="display: none;">
            <div class="d-flex flex-wrap gap-3 justify-content-start">
                @foreach ($brand_menu as $brand)
                <a href="{{ route('collections', 'all.' . $brand->brand_code) }}" class="d-flex flex-column p-2 justify-content-center align-items-center rounded-3 shadow-sm text-decoration-none text-dark" style="width: 110px; height: 110px;">
                    <img src="{{ getImage($brand->brand_image, 'brand') }}" alt="{{ $brand->brand_title }}" style="max-width: 80px; max-height: 80px; object-fit: contain;">
                    <span class="mt-2 small text-center">{{ strtoupper($brand->brand_title) }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        const mobileMenuOffcanvas = new bootstrap.Offcanvas('#mobileMenuOffcanvas');
        const mobileGlobalSearch = $('#mobile_global_search');
        const mobileSearchResults = $('#mobileSearchResults');
        const mobileSearchResultsList = $('#mobileSearchResultsList');
        const mobileTotalResult = $('#mobile_total_result');
        
        // Show backdrop when mobile menu opens
        $('#mobileMenuOffcanvas').on('show.bs.offcanvas', function() {
            showBackdrop();
        });
        
        // Hide backdrop when mobile menu closes
        $('#mobileMenuOffcanvas').on('hide.bs.offcanvas', function() {
            // Check if any dropdown is still open
            setTimeout(function() {
                const hasOpenDropdown = $('.dropdown-menu.show').not('.brandDropdownWrapper, .signatureDropdownWrapper').length > 0;
                const hasOpenCustomDropdown = $('.brandDropdownWrapper:visible, .signatureDropdownWrapper:visible').length > 0;
                const hasOpenSearch = $('#searchBar').is(':visible');
                if (!hasOpenDropdown && !hasOpenCustomDropdown && !hasOpenSearch) {
                    hideBackdrop();
                }
            }, 150);
        });
        
        // Handle submenu navigation
        $('.mobile-menu-item[data-submenu]').on('click', function(e) {
            e.preventDefault();
            const submenuId = $(this).data('submenu');
            const menuTitle = $(this).find('span').first().text();
            
            $('#mobileParentMenu').hide();
            // Capitalize first letter for ID matching
            const submenuIdCapitalized = submenuId.charAt(0).toUpperCase() + submenuId.slice(1);
            $('#mobileSubmenu' + submenuIdCapitalized).show();
            
            // Update header: show back button and update title
            $('#mobileMenuBackBtn').removeClass('d-none');
            $('#mobileMenuOffcanvasLabel').text(menuTitle);
        });
        
        // Handle back button
        $('#mobileMenuBackBtn').on('click', function(e) {
            e.preventDefault();
            $('.mobile-menu-level').hide();
            $('#mobileParentMenu').show();
            
            // Update header: hide back button and restore title
            $(this).addClass('d-none');
            $('#mobileMenuOffcanvasLabel').text('Menu');
        });
    });
</script>
@endpush

