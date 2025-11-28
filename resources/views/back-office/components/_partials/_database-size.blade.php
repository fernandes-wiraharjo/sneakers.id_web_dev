<div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
    <div class="bc-sf-filter-block-title">
        <h3><span>SIZE</span></h3>
    </div>
    @foreach ($sizeFilters as $filter)
        @php
            // Collect all EUR sizes from mapped sizes
            $eurSizes = [];
            foreach ($filter->sizes as $size) {
                if ($size->mens && $size->mens->EU) {
                    $eurSizes[] = $size->mens->EU;
                } elseif ($size->womens && $size->womens->EU) {
                    $eurSizes[] = $size->womens->EU;
                } elseif ($size->kids && $size->kids->EU) {
                    $eurSizes[] = $size->kids->EU;
                }
            }
            // Get unique EUR sizes and use the first one as the filter value
            // Since EUR sizes are the same across genders, we just need one representative value
            $eurSizes = array_unique($eurSizes);
            $filterValue = !empty($eurSizes) ? $eurSizes[0] : '';
        @endphp
        @if($filterValue)
        <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar">
            <span>
                <input type="checkbox" wire:model="size_filter" value="{{ $filterValue }}" wire:loading.attr="disabled">
                <label>{{ $filter->filter_label }}</label>
            </span>
        </div>
        @endif
    @endforeach
</div>

