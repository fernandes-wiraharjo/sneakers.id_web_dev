@push('styles')
    <style>
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }
        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }
        .filter-sidebar {
            position: sticky;
            top: 20px;
        }
        @media (max-width: 991px) {
            .filter-sidebar {
                display: none;
            }
        }
    </style>
@endpush

<div class="container-fluid">

    <div class="row">
        <div class="col-12 col-md-6 d-flex align-items-center mb-4">
            <a href="javascript:history.back()" class="border bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3 p-2">
                <span class="iconify fs-3" data-icon="stash:arrow-left-duotone"></span>
            </a>
            <h1 class="fw-bold mb-0 text-uppercase">
                {{ $page_title }}
            </h1>
        </div>
        <div class="col-12 col-md-6 mb-3 d-flex align-items-center justify-content-end flex-column flex-md-row">
            <div class="d-none d-md-flex align-items-center">
                <span class="text-muted me-2 text-nowrap">Sort by: </span>
                <select name="sort_by" id="sort_by" class="form-select text-muted rounded-pill" style="width: auto; padding: 11px 25px 11px 15px;" wire:change="handleSortChange($event.target.value)">
                    @php
                    $currentSort = $sort_column . ':' . $sort_by;
                    @endphp
                    <option value="products.created_at:DESC" {{ $currentSort == 'products.created_at:DESC' ? 'selected' : '' }}>Date, new to old</option>
                    <option value="pd.created_at:ASC" {{ $currentSort == 'pd.created_at:ASC' ? 'selected' : '' }}>Date, old to new</option>
                    <option value="product_name:ASC" {{ $currentSort == 'product_name:ASC' ? 'selected' : '' }}>Alphabetically, A-Z</option>
                    <option value="product_name:DESC" {{ $currentSort == 'product_name:DESC' ? 'selected' : '' }}>Alphabetically, Z-A</option>
                    <option value="actual_product_prize:ASC" {{ $currentSort == 'actual_product_prize:ASC' ? 'selected' : '' }}>Price, low to high</option>
                    <option value="actual_product_prize:DESC" {{ $currentSort == 'actual_product_prize:DESC' ? 'selected' : '' }}>Price, high to low</option>
                    <option value="products.updated_at:DESC" {{ $currentSort == 'products.updated_at:DESC' ? 'selected' : '' }}>Date, last updated</option>
                </select>
            </div>
            
            <div class="input-group ms-md-4 rounded-pill border py-1 px-2">
                <span class="input-group-text rounded-pill bg-white border-0 pe-0">
                    <span class="iconify fs-4" data-icon="material-symbols:search-rounded"></span>
                </span>
                <input type="text" class="form-control border-0" wire:model.debounce.500ms="search" placeholder="Search keyword..." aria-label="Search">
                <button type="button" class="btn btn-dark rounded-pill px-4 shadow" wire:click="$refresh">Search</button>
            </div>

            <div class="d-flex d-md-none gap-2 mt-3 w-100">
                <!-- Filter Button -->
                <button class="btn btn-outline-dark rounded-pill flex-fill d-flex justify-content-center align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas">
                    Filter
                    <span class="iconify ms-2" data-icon="fa6-solid:chevron-down"></span>
                </button>
                
                <!-- Sort Button -->
                <button class="btn btn-outline-dark rounded-pill flex-fill d-flex justify-content-center align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#sortOffcanvas" aria-controls="sortOffcanvas">
                    Sort
                    <span class="iconify ms-2" data-icon="fa6-solid:chevron-down"></span>
                </button>

                <!-- Filter Offcanvas for Mobile -->
                <div class="offcanvas offcanvas-start w-75" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
                    <div class="offcanvas-body ps-4">
                        <button type="button" class="btn-close float-end" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        @include('bootstrap.parts.filters', $filters)
                    </div>
                </div>

                <!-- Sort Offcanvas for Mobile -->
                <div class="offcanvas offcanvas-start w-75" tabindex="-1" id="sortOffcanvas" aria-labelledby="sortOffcanvasLabel">
                    <div class="offcanvas-body ps-4">
                        <span class="offcanvas-title fw-bold mb-5" id="sortOffcanvasLabel">Sort By</span>
                        <button type="button" class="btn-close float-end" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        @php
                        $currentSort = $sort_column . ':' . $sort_by;
                        @endphp
                        <div class="form-check py-2 mt-3">
                            <input class="form-check-input" type="radio" name="sortOption" id="sort1" value="products.created_at:DESC" {{ $currentSort == 'products.created_at:DESC' ? 'checked' : '' }} wire:change="handleSortChange($event.target.value)" onclick="document.getElementById('sortOffcanvas').querySelector('[data-bs-dismiss]').click()">
                            <label class="form-check-label w-100" for="sort1">
                                <span class="text-muted">Date, new to old</span>
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <input class="form-check-input" type="radio" name="sortOption" id="sort2" value="pd.created_at:ASC" {{ $currentSort == 'pd.created_at:ASC' ? 'checked' : '' }} wire:change="handleSortChange($event.target.value)" onclick="document.getElementById('sortOffcanvas').querySelector('[data-bs-dismiss]').click()">
                            <label class="form-check-label w-100" for="sort2">
                                <span class="text-muted">Date, old to new</span>
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <input class="form-check-input" type="radio" name="sortOption" id="sort3" value="product_name:ASC" {{ $currentSort == 'product_name:ASC' ? 'checked' : '' }} wire:change="handleSortChange($event.target.value)" onclick="document.getElementById('sortOffcanvas').querySelector('[data-bs-dismiss]').click()">
                            <label class="form-check-label w-100" for="sort3">
                                <span class="text-muted">Alphabetically, A-Z</span>
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <input class="form-check-input" type="radio" name="sortOption" id="sort4" value="product_name:DESC" {{ $currentSort == 'product_name:DESC' ? 'checked' : '' }} wire:change="handleSortChange($event.target.value)" onclick="document.getElementById('sortOffcanvas').querySelector('[data-bs-dismiss]').click()">
                            <label class="form-check-label w-100" for="sort4">
                                <span class="text-muted">Alphabetically, Z-A</span>
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <input class="form-check-input" type="radio" name="sortOption" id="sort5" value="actual_product_prize:ASC" {{ $currentSort == 'actual_product_prize:ASC' ? 'checked' : '' }} wire:change="handleSortChange($event.target.value)" onclick="document.getElementById('sortOffcanvas').querySelector('[data-bs-dismiss]').click()">
                            <label class="form-check-label w-100" for="sort5">
                                <span class="text-muted">Price, low to high</span>
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <input class="form-check-input" type="radio" name="sortOption" id="sort6" value="actual_product_prize:DESC" {{ $currentSort == 'actual_product_prize:DESC' ? 'checked' : '' }} wire:change="handleSortChange($event.target.value)" onclick="document.getElementById('sortOffcanvas').querySelector('[data-bs-dismiss]').click()">
                            <label class="form-check-label w-100" for="sort6">
                                <span class="text-muted">Price, high to low</span>
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <input class="form-check-input" type="radio" name="sortOption" id="sort7" value="products.updated_at:DESC" {{ $currentSort == 'products.updated_at:DESC' ? 'checked' : '' }} wire:change="handleSortChange($event.target.value)" onclick="document.getElementById('sortOffcanvas').querySelector('[data-bs-dismiss]').click()">
                            <label class="form-check-label w-100" for="sort7">
                                <span class="text-muted">Date, last updated</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar Filters (Desktop) -->
        <div class="col-md-2 filter-sidebar">
            @include('bootstrap.parts.filters', $filters)
        </div>

        <!-- Products Grid -->
        <div class="col-md-10">
            <div wire:loading class="text-center py-5">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div wire:loading.remove>
                @forelse ($products as $product)
                    <div class="product-grid">
                        @include('bootstrap.parts.product-card', ['item' => $product])
                    </div>
                @empty
                    <div class="text-center py-5">
                        <img src="{{ asset('stores-info/product-not-found.webp') }}" alt="Not Found" class="img-fluid">
                        <h4 class="fw-bold">Oops, product not found</h4>
                        <p class="text-muted">Try another keyword</p>
                    </div>
                @endforelse
                
                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $products->onEachSide(3)->links('vendor.livewire.bootstrap') }}
                </div>
            </div>
        </div>
    </div>
</div>