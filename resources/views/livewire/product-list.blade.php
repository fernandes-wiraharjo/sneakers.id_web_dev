<div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="app-container container-xxl-12 " id="kt_app_content_container">
            <div class="-flex flex-row-fluid">
                <div class="input-group input-group-lg flex-nowrap">
                    <input type="text" class="form-control flex-lg-grow-1 rounded-start-0 rounded-end-0 bg-transparent h-60px" placeholder="SEARCH . . ." aria-label="keyword" aria-describedby="basic-addon1" wire:model="search"/>
                    <div class="overflow-hidden" style="width: 20%; max-width: 300px;">
                        <button type="button" class="form-select form-select-lg rounded-start-0 rounded-end-0 bg-transparent h-60px menu-dropdown" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-target="#sort">
                            SORT
                        </button>
                        <div class="menu menu-sub menu-sub-dropdown min-w-300px text-end mt-5" style="border-radius: 0;" data-kt-menu="true" id="sort">
                            <a class="px-12 py-3 fs-4 text-black cursor-pointer" wire:click="sort('product_name', 'ASC')" value="product_name.ASC">
                                Alphabetically, A-Z
                            </a>
                            <a class="px-12 py-3 fs-4 text-black cursor-pointer" wire:click="sort('product_name', 'DESC')" value="product_name.DESC">
                                Alphabetically, Z-A
                            </a>
                            <a class="px-12 py-3 fs-4 text-black cursor-pointer" wire:click="sort('pd.retail_price', 'ASC')" value="pd.retail_price.ASC">
                                Price, low to high
                            </a>
                            <a class="px-12 py-3 fs-4 text-black cursor-pointer" wire:click="sort('pd.retail_price', 'DESC')" value="pd.retail_price.DESC">
                                Price, high to low
                            </a>
                            <a class="px-12 py-3 fs-4 text-black cursor-pointer" wire:click="sort('pd.after_discount_price', 'ASC')" value="pd.after_discount_price.ASC">
                                Discount Price, low to high
                            </a>
                            <a class="px-12 py-3 fs-4 text-black cursor-pointer" wire:click="sort('pd.after_discount_price', 'DESC')" value="pd.after_discount_priceDESC">
                                Disount Price, high to low
                            </a>
                            <a class="px-12 py-3 fs-4 text-black cursor-pointer" wire:click="sort('created_at', 'ASC')" value="created_at.ASC">
                                Date, old to new
                            </a>
                            <a class="px-12 py-3 fs-4 text-black cursor-pointer" wire:click="sort('created_at', 'DESC')" value="created_at.DESC">
                                Date, new to old
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-xl-row">
                <div class="flex-row-auto w-xl-375px">
                    <div class="card bg-transparent">
                        <div class="card-body bg">
                            <div class="row mb-1">
                                @include('components.filters', $filters)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex me-xl-9 mb-10 mb-xl-0">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-wrap d-grid gap-1 gap-sm-1">
                            @foreach ($products as $product)
                                <a href="{{ route('product-detail', [$product->id, str_replace(' ', '_', $product->product_name)]) }}">
                                    <!--begin::Card-->
                                    <div class="card card-flush flex-row-fluid pb-5 mw-100 bg-transparent p-0">
                                        <!--begin::Body-->
                                        <div class="card-body text-center p-0">
                                            <!--begin::Food img-->
                                            @foreach ($product->images()->limit(1)->get() as $key => $image)
                                                <img src="{{ getImage($image->image_url, 'products/'.$product->product_code) }}" class="rounded-3 mb-4 w-250px h-250px w-xxl-300px h-xxl-300px" alt="{{ $product->product_name }}">
                                            @endforeach
                                            <!--end::Food img-->
                                            <div class="mb-0" style="text-align: -webkit-center;">
                                                <!--begin::Name-->
                                                <a href="#" class="text-dark fw-bold text-hover-primary fs-3">{{$product->detail->brand->brand_title}}</a>
                                                <!--end::Name-->
                                                <div class="w-200px">
                                                        <!--begin::Position-->
                                                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-n1 mh-60px" style="overflow-wrap: break-word; min-height: 45px;">
                                                        {{-- product Name --}}
                                                            <a href="{{ route('product-detail', [$product->id, str_replace(' ', '_', $product->product_name)]) }}">{{$product->product_name}}</a>
                                                    </span>
                                                </div>
                                                <!--begin::Position-->
                                                <!--begin::Total-->
                                                <span class="text-danger text-end fw-bold fs-1">
                                                    @if ($product->detail->after_discount_price > 0 && $product->detail->after_discount_price < $product->detail->retail_price)
                                                        <span class="money">
                                                            RP
                                                            <del class="fs-5">
                                                                {{ rupiah_format(intval($product->detail->retail_price ?? 0)) }}
                                                            </del>
                                                            <span style="position:inherit; font-weight: 600;">
                                                                {{ rupiah_format(intval($product->detail->after_discount_price ?? 0)) }}</span>
                                                        </span>
                                                    @else
                                                        <span class="money" >RP
                                                            {{ rupiah_format(intval($product->detail->retail_price ?? 0)) }}
                                                        </span>
                                                    @endif
                                                </span>
                                                <!--end::Total-->
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Card-->
                                </a>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center last-column">
                            {{ $products->links('partials.layout.pagination') }}
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
            </div>
        </div>
    </div>
</div>
