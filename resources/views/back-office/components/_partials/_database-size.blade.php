<div class="bc-sf-filter-option-block bc-sf-filter-option-block-list bc-sf-filter-option-block-category">
    <div class="bc-sf-filter-block-title">
        <h3><span>SIZE</span></h3>
    </div>
    @foreach ($sizeFilters as $filter)
        @if(!empty($filter->eu_sizes) && count($filter->eu_sizes) > 0)
        <div class="Check__Box__Container bc-sf-filter-block-content no-scrollbar">
            <span>
                <input type="checkbox" wire:model="size_filter" value="{{ $filter->filter_label }}" wire:loading.attr="disabled">
                <label>{{ $filter->filter_label }}</label>
            </span>
        </div>
        @endif
    @endforeach
</div>

