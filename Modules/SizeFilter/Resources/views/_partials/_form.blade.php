<div class="row">
    <div class="col-md-8">
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="required fs-6 fw-bold mb-2">Filter Label</label>
            <input type="text" class="form-control form-control-solid @error('filter_label') is-invalid @enderror" 
                placeholder="e.g., 42" name="filter_label" 
                value="{{ old('filter_label', $sizeFilter->filter_label) }}" required />
            <div class="form-text">This is the label that will appear in the filter (e.g., "42", "36-37", "Large").</div>
            @error('filter_label')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="required fs-6 fw-bold mb-2">Mapped Sizes</label>
            <div class="card">
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                    <div class="form-text mb-4">
                        Select the actual sizes that should be included when this filter is selected. You can select multiple sizes.
                    </div>
                    <div class="row">
                        @php
                            // Sort sizes by EUR size (low to high)
                            $sortedSizes = $sizes->sort(function($a, $b) {
                                $euA = null;
                                if ($a->mens && $a->mens->EU) {
                                    $euA = $a->mens->EU;
                                } elseif ($a->womens && $a->womens->EU) {
                                    $euA = $a->womens->EU;
                                } elseif ($a->kids && $a->kids->EU) {
                                    $euA = $a->kids->EU;
                                }
                                
                                $euB = null;
                                if ($b->mens && $b->mens->EU) {
                                    $euB = $b->mens->EU;
                                } elseif ($b->womens && $b->womens->EU) {
                                    $euB = $b->womens->EU;
                                } elseif ($b->kids && $b->kids->EU) {
                                    $euB = $b->kids->EU;
                                }
                                
                                // Handle null values - put them at the end
                                if ($euA === null && $euB === null) return 0;
                                if ($euA === null) return 1;
                                if ($euB === null) return -1;
                                
                                // Compare as floats for proper numeric sorting
                                return floatval($euA) <=> floatval($euB);
                            });
                        @endphp
                        @foreach($sortedSizes as $size)
                        <div class="col-md-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input @error('sizes') is-invalid @enderror" 
                                    type="checkbox" 
                                    name="sizes[]" 
                                    value="{{ $size->id }}" 
                                    id="size_{{ $size->id }}"
                                    {{ in_array($size->id, old('sizes', $selectedSizes ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="size_{{ $size->id }}">
                                    {{ $size->size_title }}
                                    @php
                                        $eu = null;
                                        if ($size->mens && $size->mens->EU) {
                                            $eu = $size->mens->EU;
                                        } elseif ($size->womens && $size->womens->EU) {
                                            $eu = $size->womens->EU;
                                        } elseif ($size->kids && $size->kids->EU) {
                                            $eu = $size->kids->EU;
                                        }
                                    @endphp
                                    @if($eu)
                                    <small class="text-muted">(EUR: {{ $eu }})</small>
                                    @endif
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @error('sizes')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="required fs-6 fw-bold mb-2">Sort Order</label>
            <input type="number" class="form-control form-control-solid @error('sort_order') is-invalid @enderror" 
                placeholder="0" name="sort_order" 
                value="{{ old('sort_order', $sizeFilter->sort_order ?? 0) }}" 
                min="0" required />
            <div class="form-text">Lower numbers appear first in the filter list.</div>
            @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold mb-2">Status</label>
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" 
                    id="is_active" {{ old('is_active', $sizeFilter->is_active ?? true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    Active
                </label>
            </div>
            <div class="form-text">Only active filters will be displayed on the storefront.</div>
        </div>
        <!--end::Input group-->
    </div>

    <div class="col-md-4">
        <!--begin::Help card-->
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title">How to use Size Filters</h5>
                <p class="card-text">
                    <strong>Filter Label:</strong> This is what customers will see in the filter (e.g., "42").
                </p>
                <p class="card-text">
                    <strong>Mapped Sizes:</strong> Select all size variations that should be included when this filter is applied.
                </p>
                <p class="card-text text-muted small">
                    <strong>Example:</strong><br>
                    Filter Label: "42"<br>
                    Mapped Sizes: 42, 42 1/3, 42.5<br><br>
                    When a customer selects "42" in the filter, products with any of these sizes will be shown.
                </p>
            </div>
        </div>
        <!--end::Help card-->
    </div>
</div>

@push('scripts')
<script>
    // Form submit loading indicator
    const form = document.getElementById('form');
    const submitButton = document.getElementById('form-submit');
    
    form.addEventListener('submit', function() {
        submitButton.setAttribute('data-kt-indicator', 'on');
        submitButton.disabled = true;
    });
</script>
@endpush

