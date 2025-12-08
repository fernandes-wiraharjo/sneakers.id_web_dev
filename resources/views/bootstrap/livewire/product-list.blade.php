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
