@php
    $hardcodedSizes = [
        ['value' => '35', 'label' => '35.5'],
        ['value' => '36', 'label' => '36 - 36.5'],
        ['value' => '37', 'label' => '37.5'],
        ['value' => '38', 'label' => '38 - 38.5'],
        ['value' => '39', 'label' => '39'],
        ['value' => '40', 'label' => '40 - 40.5'],
        ['value' => '41', 'label' => '41'],
        ['value' => '42', 'label' => '42 - 42.5'],
        ['value' => '43', 'label' => '43'],
        ['value' => '44', 'label' => '44 - 44.5'],
        ['value' => '45', 'label' => '45 - 45.5'],
        ['value' => '46', 'label' => '46 - 46.5'],
        ['value' => '47', 'label' => '47 - 47.5'],
        ['value' => '48', 'label' => '48 - 48.5'],
        ['value' => '49', 'label' => '49'],
    ];
    $sizeFirst = array_slice($hardcodedSizes, 0, 7);
    $sizeRest = array_slice($hardcodedSizes, 7);
@endphp
<p class="fw-bold mt-4 mb-2">Size</p>
@foreach ($sizeFirst as $s)
    <div class="form-check">
        <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="{{ $s['value'] }}" id="size_{{ $s['value'] }}">
        <label class="form-check-label" for="size_{{ $s['value'] }}">
            <span class="text-muted">{{ $s['label'] }}</span>
        </label>
    </div>
@endforeach
@if(count($sizeRest) > 0)
    <div class="filter-more-wrap mt-1">
        <div class="filter-more-items" style="display:none;">
            @foreach ($sizeRest as $s)
                <div class="form-check">
                    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="{{ $s['value'] }}" id="size_rest_{{ $s['value'] }}">
                    <label class="form-check-label" for="size_rest_{{ $s['value'] }}">
                        <span class="text-muted">{{ $s['label'] }}</span>
                    </label>
                </div>
            @endforeach
        </div>
        <a href="#" class="filter-more-link text-danger small text-decoration-underline" data-more-text="{{ count($sizeRest) }} more">{{ count($sizeRest) }} more</a>
    </div>
@endif

