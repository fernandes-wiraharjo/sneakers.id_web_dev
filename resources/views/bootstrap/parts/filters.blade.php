<p class="fs-5 fw-bold mb-4">Filter</p>

<!-- Brand Section -->
@if(isset($brand) && count($brand) > 0)
    <p class="fw-bold mt-4 mb-2">Brand</p>
    @foreach ($brand as $item)
        <div class="form-check">
            <input class="form-check-input" wire:model="brand" wire:loading.attr="disabled" type="checkbox" value="{{ $item->id }}" id="brand{{ $item->id }}">
            <label class="form-check-label" for="brand{{ $item->id }}">
                <span class="text-muted">{{ $item->brand_title }}</span>
            </label>
        </div>
    @endforeach
@endif

<!-- Gender Section -->
<p class="fw-bold mt-4 mb-2">Gender</p>
<div class="form-check">
    <input class="form-check-input" wire:model="gender" wire:loading.attr="disabled" type="checkbox" value="MENS" id="gender_mens">
    <label class="form-check-label" for="gender_mens">
        <span class="text-muted">Men's</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="gender" wire:loading.attr="disabled" type="checkbox" value="WOMENS" id="gender_womens">
    <label class="form-check-label" for="gender_womens">
        <span class="text-muted">Women's</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="gender" wire:loading.attr="disabled" type="checkbox" value="KIDS" id="gender_kids">
    <label class="form-check-label" for="gender_kids">
        <span class="text-muted">Kid's</span>
    </label>
</div>

<!-- Age Range Section -->
<p class="fw-bold mt-4 mb-2">Age Range</p>
<div class="form-check">
    <input class="form-check-input" wire:model="age_range" wire:loading.attr="disabled" type="checkbox" value="GRADE_SCHOOL" id="age_grade_school">
    <label class="form-check-label" for="age_grade_school">
        <span class="text-muted">Grade School</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="age_range" wire:loading.attr="disabled" type="checkbox" value="PRESCHOOL" id="age_preschool">
    <label class="form-check-label" for="age_preschool">
        <span class="text-muted">Preschool</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="age_range" wire:loading.attr="disabled" type="checkbox" value="TODDLER" id="age_toddler">
    <label class="form-check-label" for="age_toddler">
        <span class="text-muted">Toddler</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="age_range" wire:loading.attr="disabled" type="checkbox" value="INFANT" id="age_infant">
    <label class="form-check-label" for="age_infant">
        <span class="text-muted">Infant</span>
    </label>
</div>

<!-- Category Section -->
@if(isset($category) && count($category) > 0)
    <p class="fw-bold mt-4 mb-2">Category</p>
    @foreach ($category as $item)
        <div class="form-check">
            <input class="form-check-input" wire:model="category" wire:loading.attr="disabled" type="checkbox" value="{{ $item->id }}" id="category{{ $item->id }}">
            <label class="form-check-label" for="category{{ $item->id }}">
                <span class="text-muted">{{ $item->category_title }}</span>
            </label>
        </div>
    @endforeach
@endif

<!-- Size Section -->
@if(config('app.size_filter_mode') === 'database')
    @include('bootstrap.parts._database-size', ['sizeFilters' => $sizeFilters ?? []])
@else
    @include('bootstrap.parts._hardcoded-size')
@endif

<!-- Signature Player Section -->
@if(isset($signature_player) && count($signature_player) > 0)
    @php
        $signaturePlayerList = is_array($signature_player) ? collect($signature_player) : $signature_player;
        $signatureFirst = $signaturePlayerList->take(7);
        $signatureRest = $signaturePlayerList->skip(7);
    @endphp
    <p class="fw-bold mt-4 mb-2">Signature Player</p>
    @foreach ($signatureFirst as $item)
        <div class="form-check">
            <input class="form-check-input" wire:model="signature" wire:loading.attr="disabled" type="checkbox" value="{{ $item->id }}" id="signature{{ $item->id }}">
            <label class="form-check-label" for="signature{{ $item->id }}">
                <span class="text-muted">{{ $item->signature_title }}</span>
            </label>
        </div>
    @endforeach
    @if($signatureRest->isNotEmpty())
        <div class="filter-more-wrap mt-1">
            <div class="filter-more-items" style="display:none;">
                @foreach ($signatureRest as $item)
                    <div class="form-check">
                        <input class="form-check-input" wire:model="signature" wire:loading.attr="disabled" type="checkbox" value="{{ $item->id }}" id="signature{{ $item->id }}">
                        <label class="form-check-label" for="signature{{ $item->id }}">
                            <span class="text-muted">{{ $item->signature_title }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
            <a href="#" class="filter-more-link text-danger small text-decoration-underline" data-more-text="{{ $signatureRest->count() }} more">{{ $signatureRest->count() }} more</a>
        </div>
    @endif
@endif

@push('scripts')
<script>
(function($) {
    $(document).off('click.filterMore', '.filter-more-link').on('click.filterMore', '.filter-more-link', function(e) {
        e.preventDefault();
        var $wrap = $(this).closest('.filter-more-wrap');
        var $items = $wrap.find('.filter-more-items');
        var $link = $(this);
        $items.toggle();
        $link.text($items.is(':visible') ? 'Less' : $link.data('more-text'));
    });
})(jQuery);
</script>
@endpush