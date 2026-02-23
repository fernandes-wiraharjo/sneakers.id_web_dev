@php
    $sizeList = collect($sizeFilters ?? [])->filter(fn($f) => !empty($f->eu_sizes) && count($f->eu_sizes) > 0)->values();
    $sizeFirst = $sizeList->take(7);
    $sizeRest = $sizeList->skip(7);
@endphp
<p class="fw-bold mt-4 mb-2">Size</p>
@foreach ($sizeFirst as $filter)
    <div class="form-check">
        <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="{{ $filter->filter_label }}" id="size_{{ $filter->id ?? $loop->index }}">
        <label class="form-check-label" for="size_{{ $filter->id ?? $loop->index }}">
            <span class="text-muted">{{ $filter->filter_label }}</span>
        </label>
    </div>
@endforeach
@if($sizeRest->isNotEmpty())
    <div class="filter-more-wrap mt-1">
        <div class="filter-more-items" style="display:none;">
            @foreach ($sizeRest as $filter)
                <div class="form-check">
                    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="{{ $filter->filter_label }}" id="size_rest_{{ $filter->id ?? $loop->index }}">
                    <label class="form-check-label" for="size_rest_{{ $filter->id ?? $loop->index }}">
                        <span class="text-muted">{{ $filter->filter_label }}</span>
                    </label>
                </div>
            @endforeach
        </div>
        <a href="#" class="filter-more-link text-danger small text-decoration-underline" data-more-text="{{ $sizeRest->count() }} more">{{ $sizeRest->count() }} more</a>
    </div>
@endif

