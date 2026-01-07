<p class="fw-bold mt-4 mb-2">Size</p>
@foreach ($sizeFilters as $filter)
    @if(!empty($filter->eu_sizes) && count($filter->eu_sizes) > 0)
    <div class="form-check">
        <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="{{ $filter->filter_label }}" id="size_{{ $filter->id ?? $loop->index }}">
        <label class="form-check-label" for="size_{{ $filter->id ?? $loop->index }}">
            <span class="text-muted">{{ $filter->filter_label }}</span>
        </label>
    </div>
    @endif
@endforeach

