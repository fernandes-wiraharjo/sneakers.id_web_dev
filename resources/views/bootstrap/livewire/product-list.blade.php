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

<!-- Mobile Filter & Sort Buttons -->
<div class="row d-md-none mb-3">
    <div class="col-6">
        <button class="btn btn-outline-dark w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas">
            <span class="iconify" data-icon="mdi:filter"></span> Filter
        </button>
    </div>
    <div class="col-6">
        <div class="dropdown w-100">
            <button class="btn btn-outline-dark w-100 dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Sort
            </button>
            <ul class="dropdown-menu w-100" aria-labelledby="sortDropdown">
                <li><a class="dropdown-item" href="#" wire:click="sort('product_name', 'ASC')">Alphabetically, A-Z</a></li>
                <li><a class="dropdown-item" href="#" wire:click="sort('product_name', 'DESC')">Alphabetically, Z-A</a></li>
                <li><a class="dropdown-item" href="#" wire:click="sort('actual_product_prize', 'ASC')">Price, low to high</a></li>
                <li><a class="dropdown-item" href="#" wire:click="sort('actual_product_prize', 'DESC')">Price, high to low</a></li>
                <li><a class="dropdown-item" href="#" wire:click="sort('pd.created_at', 'ASC')">Date, old to new</a></li>
                <li><a class="dropdown-item" href="#" wire:click="sort('pd.created_at', 'DESC')">Date, new to old</a></li>
                <li><a class="dropdown-item" href="#" wire:click="sort('products.updated_at', 'DESC')">Date, last updated</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Product Count -->
<div class="row mb-3">
    <div class="col-12">
        <p class="text-muted mb-0">{{ $total_product }} PRODUCTS</p>
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
            <div class="product-grid">
                @foreach ($products as $product)
                    @include('bootstrap.parts.product-card', ['item' => $product])
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $products->onEachSide(1)->links('vendor.livewire.bootstrap') }}
            </div>
        </div>
    </div>
</div>

<!-- Mobile Filter Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="filterOffcanvasLabel">Filters</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @include('bootstrap.parts.filters', $filters)
    </div>
</div>
