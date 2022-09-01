<div>
    <div class="d-flex flex-col m-2">
        <input type="text" class="form-control flex-lg-grow-1 rounded-start-0 rounded-end-0 bg-transparent " placeholder="SEARCH . . ." aria-label="keyword" aria-describedby="basic-addon1" wire:model="search" id="myInput" onkeyup="filterFunction()"/>
        <button wire:ignore.self class="Search__Close Link Link--primary mx-2"><svg class="Icon Icon--close" role="presentation" viewBox="0 0 16 14">
            <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd"></path>
        </svg></button>
    </div>
    @if ($search)
        <div class="result m-2">
            @foreach ($products as $item)
                <a href="{{ route('product-detail', [$item->id, str_replace(' ', '_', $item->product_name)]) }}">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-3">
                            @foreach ($item->images()->limit(1)->get() as $key => $image)
                                <img src="{{ getImage($image->image_url, 'products/'.$item->product_code) }}" class="no-radius" alt="">
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-start flex-column">
                            <h4><b>{{$item->product_name}}</b></h4>
                            <span class="text-gray-400 fw-semibold d-block fs-7">
                                @if ($item->detail->after_discount_price > 0 && $item->detail->after_discount_price < $item->detail->retail_price)
                                    RP<del class="fs-9">
                                        {{ rupiah_format(intval($item->detail->retail_price ?? 0)) }}
                                    </del>
                                    <span style="position:inherit; font-weight: 800;">
                                    {{ rupiah_format(intval($item->detail->after_discount_price ?? 0)) }}</span>
                                @else
                                    RP {{ rupiah_format(intval($item->detail->retail_price ?? 0)) }}
                                @endif
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        @if ($products->count() > 9)
            <div class="m-2 text-center">
                <a href="{{ route('collections', $search)}}">SEE MORE</a>
            </div>
        @elseif($products->count() == 0)
            <div class="m-2 text-center">
                <span class="text-gray-400 fw-semibold d-block fs-7" >NO RESULT FOUND</span>
            </div>
        @endif
    @else
        @if ($products->count() == 0)
            <div class="m-2 text-center">
                <span class="text-gray-400 fw-semibold d-block fs-7" >NO RESULT FOUND</span>
            </div>
        @endif
    @endif
</div>
