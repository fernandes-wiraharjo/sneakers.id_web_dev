<div class="CollectionFilters">
    <div id="bc-sf-filter-tree-mobile"><button id="bc-sf-filter-tree-mobile-button" type="button">FILTER</button></div>
    <div>
        <div id="bc-sf-filter-options-wrapper">
            <div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
                <div class="bc-sf-filter-block-title">
                    <h3><span>BRAND</span></h3>
                </div>
                @foreach ($brand as $item)
                    <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar">
                        <input type="checkbox" wire:model="brand" value="{{$item->id}}" wire:loading.attr="disabled">
                        {{-- <span class="Checkmark_Container"></span> --}}
                        <label>{{ strtoupper($item->brand_title) }}</label>
                    </div>
                @endforeach
            </div>
            <div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
                <div class="bc-sf-filter-block-title">
                    <h3><span>CATEGORY</span></h3>
                </div>
                @foreach ($category as $item)
                    <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar" >
                        <input type="checkbox" wire:model="category" value="{{$item->id}}" wire:loading.attr="disabled" id="category">
                        {{-- <span class="Checkmark_Container"></span> --}}
                        <label>{{ strtoupper($item->category_title) }}</label>
                    </div>
                @endforeach
            </div>
            <div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
                <div class="bc-sf-filter-block-title">
                    <h3><span>TAG</span></h3>
                </div>
                @foreach ($tag as $item)
                    <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar" >
                        <input type="checkbox" wire:model="tag" value="{{$item->id}}" wire:loading.attr="disabled">
                        {{-- <span class="Checkmark_Container"></span> --}}
                        <label>{{ strtoupper($item->tag_title) }}</label>
                    </div>
                @endforeach
            </div>
            <div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
                <div class="bc-sf-filter-block-title">
                    <h3><span>SIGNATURE PLAYER</span></h3>
                </div>
                @foreach ($signature_player as $item)
                    <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar" >
                        <input type="checkbox" wire:model="signature" value="{{$item->id}}" wire:loading.attr="disabled">
                        {{-- <span class="Checkmark_Container"></span> --}}
                        <label>{{ strtoupper($item->signature_title) }}</label>
                    </div>
                @endforeach
            </div>
            <!-- Disabled
            <div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
                <div class="bc-sf-filter-block-title">
                    <h3><span>SIZE</span></h3>
                </div>
                <div class="bc-sf-filter-block-content" >
                    <div class="grid-flow">
                        @foreach ($size as $count => $item)
                            <span>
                                <input type="checkbox" wire:model="size" value="{{$item->id}}">
                                <label>{{ $item->size_title}}</label>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>
</div>
