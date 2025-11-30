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
            <label class="required fs-6 fw-bold mb-2">Mapped EU Sizes</label>
            <div class="card">
                <div class="card-body">
                    <div class="form-text mb-4">
                        Enter the EU sizes that should be included when this filter is selected. You can add multiple EU sizes manually (e.g., "42 1/3", "42.5", "42") or enter comma-separated values in a single field (e.g., "49, 49.5, 49 1/3").
                    </div>
                    <div id="eu-sizes-container">
                        @php
                            $oldEuSizes = old('eu_sizes', $euSizes ?? []);
                            if (empty($oldEuSizes)) {
                                $oldEuSizes = [''];
                            }
                        @endphp
                        @foreach($oldEuSizes as $index => $euSize)
                        <div class="input-group mb-3 eu-size-input-group">
                            <input type="text" 
                                class="form-control form-control-solid @error('eu_sizes.' . $index) is-invalid @enderror" 
                                name="eu_sizes[]" 
                                value="{{ $euSize }}" 
                                placeholder="e.g., 42 1/3, 42.5, 42 (or single value)"
                                maxlength="200">
                            @if($index > 0 || count($oldEuSizes) > 1)
                            <button type="button" class="btn btn-sm btn-light-danger remove-eu-size" type="button">
                                <i class="fas fa-times"></i>
                            </button>
                            @endif
                            @error('eu_sizes.' . $index)
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-light-primary" id="add-eu-size">
                        <i class="fas fa-plus"></i> Add EU Size
                    </button>
                    @error('eu_sizes')
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
                    <strong>Mapped EU Sizes:</strong> Enter all EU size variations manually that should be included when this filter is applied.
                </p>
                <p class="card-text text-muted small">
                    <strong>Example:</strong><br>
                    Filter Label: "42.5"<br>
                    Mapped EU Sizes: 42 1/3, 42.5<br><br>
                    When a customer selects "42.5" in the filter, products with sizes ending in any of these EU sizes will be shown (e.g., "US / EU (11 / 42.5)").
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

    // Add EU size input
    document.getElementById('add-eu-size').addEventListener('click', function() {
        const container = document.getElementById('eu-sizes-container');
        const newInput = document.createElement('div');
        newInput.className = 'input-group mb-3 eu-size-input-group';
        newInput.innerHTML = `
            <input type="text" 
                class="form-control form-control-solid" 
                name="eu_sizes[]" 
                value="" 
                placeholder="e.g., 42 1/3, 42.5, 42 (or single value)"
                maxlength="200">
            <button type="button" class="btn btn-sm btn-light-danger remove-eu-size" type="button">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(newInput);
    });

    // Remove EU size input
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-eu-size')) {
            const inputGroup = e.target.closest('.eu-size-input-group');
            if (inputGroup) {
                inputGroup.remove();
            }
        }
    });
</script>
@endpush

