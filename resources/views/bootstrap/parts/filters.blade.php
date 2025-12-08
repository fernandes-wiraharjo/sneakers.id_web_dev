<p class="fs-5 fw-bold mb-4">Filter</p>

<!-- Brand Section -->
@if(isset($brand) && count($brand) > 0)
    <p class="fw-bold mt-4 mb-2">Brand</p>
    @foreach ($brand as $item)
        <div class="form-check">
            <input class="form-check-input" wire:model="brand" wire:loading.attr="disabled" type="checkbox" value="{{ $item->id }}" id="brand{{ $item->id }}">
            <label class="form-check-label" for="brand{{ $item->id }}">
                @if(isset($item->brand_image))
                    <img src="{{ getImage($item->brand_image, 'brand') }}" alt="{{ $item->brand_title }}" class="img-fluid mx-1" style="width: 20px; height: 20px;">
                @endif
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

<!-- Tag Section -->
@if(isset($tag) && count($tag) > 0)
    <p class="fw-bold mt-4 mb-2">Tag</p>
    @foreach ($tag as $item)
        <div class="form-check">
            <input class="form-check-input" wire:model="tag" wire:loading.attr="disabled" type="checkbox" value="{{ $item->id }}" id="tag{{ $item->id }}">
            <label class="form-check-label" for="tag{{ $item->id }}">
                <span class="text-muted">{{ $item->tag_title }}</span>
            </label>
        </div>
    @endforeach
@endif

<!-- Size Section -->
<p class="fw-bold mt-4 mb-2">Size</p>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="35" id="size_35">
    <label class="form-check-label" for="size_35">
        <span class="text-muted">35.5</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="36" id="size_36">
    <label class="form-check-label" for="size_36">
        <span class="text-muted">36 - 36.5</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="37" id="size_37">
    <label class="form-check-label" for="size_37">
        <span class="text-muted">37.5</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="38" id="size_38">
    <label class="form-check-label" for="size_38">
        <span class="text-muted">38 - 38.5</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="39" id="size_39">
    <label class="form-check-label" for="size_39">
        <span class="text-muted">39</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="40" id="size_40">
    <label class="form-check-label" for="size_40">
        <span class="text-muted">40 - 40.5</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="41" id="size_41">
    <label class="form-check-label" for="size_41">
        <span class="text-muted">41</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="42" id="size_42">
    <label class="form-check-label" for="size_42">
        <span class="text-muted">42 - 42.5</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="43" id="size_43">
    <label class="form-check-label" for="size_43">
        <span class="text-muted">43</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="44" id="size_44">
    <label class="form-check-label" for="size_44">
        <span class="text-muted">44 - 44.5</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="45" id="size_45">
    <label class="form-check-label" for="size_45">
        <span class="text-muted">45 - 45.5</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="46" id="size_46">
    <label class="form-check-label" for="size_46">
        <span class="text-muted">46 - 46.5</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="47" id="size_47">
    <label class="form-check-label" for="size_47">
        <span class="text-muted">47 - 47.5</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="48" id="size_48">
    <label class="form-check-label" for="size_48">
        <span class="text-muted">48 - 48.5</span>
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" wire:model="size_filter" wire:loading.attr="disabled" type="checkbox" value="49" id="size_49">
    <label class="form-check-label" for="size_49">
        <span class="text-muted">49</span>
    </label>
</div>

<!-- Signature Player Section -->
@if(isset($signature_player) && count($signature_player) > 0)
    <p class="fw-bold mt-4 mb-2">Signature Player</p>
    @foreach ($signature_player as $item)
        <div class="form-check">
            <input class="form-check-input" wire:model="signature" wire:loading.attr="disabled" type="checkbox" value="{{ $item->id }}" id="signature{{ $item->id }}">
            <label class="form-check-label" for="signature{{ $item->id }}">
                <span class="text-muted">{{ $item->signature_title }}</span>
            </label>
        </div>
    @endforeach
@endif
