@php
    $applyTo = old('apply_to', $voucher->apply_to ?? \Modules\DiscountVoucher\Entities\DiscountVoucher::APPLY_TO_CART);
    $applyToOptions = \Modules\DiscountVoucher\Entities\DiscountVoucher::applyToOptions();
@endphp

{{-- General Information Section --}}
<h3>General Information</h3>
<br>

<div class="row mb-10">
    <label class="col-lg-3 col-form-label fw-bold fs-6">Voucher Code *</label>
    <div class="col-lg-9">
        <input type="text" placeholder="Voucher Code (e.g., SNKR2024)" class="form-control" name="voucher_code" id="voucher_code" required
            value="{{ old('voucher_code', $voucher->voucher_code) ?? $voucher_code }}">
    </div>
</div>

<div class="row mb-10">
    <label class="col-lg-3 col-form-label fw-bold fs-6">Valid From *</label>
    <div class="col-lg-9">
        <input type="date" class="form-control" name="valid_from" id="valid_from" required
            value="{{ old('valid_from', $voucher->valid_from ? $voucher->valid_from->format('Y-m-d') : '') }}">
    </div>
</div>

<div class="row mb-10">
    <label class="col-lg-3 col-form-label fw-bold fs-6">Valid Until *</label>
    <div class="col-lg-9">
        <input type="date" class="form-control" name="valid_until" id="valid_until" required
            value="{{ old('valid_until', $voucher->valid_until ? $voucher->valid_until->format('Y-m-d') : '') }}">
    </div>
</div>

<hr>
<h3>Discount Parameters</h3>
<br>

{{-- Apply To --}}
<div class="row mb-10">
    <label class="col-lg-3 col-form-label fw-bold fs-6">Apply Discount To *</label>
    <div class="col-lg-9">
        @foreach ($applyToOptions as $value => $label)
            <div class="form-check form-check-custom form-check-solid mb-5">
                <input class="form-check-input" type="radio" name="apply_to" id="apply_to_{{ $value }}" value="{{ $value }}"
                    {{ $applyTo === $value ? 'checked' : '' }} onchange="updateMinPurchaseLabel()">
                <label class="form-check-label" for="apply_to_{{ $value }}">
                    {{ $label }}
                </label>
            </div>
        @endforeach
    </div>
</div>

<div class="row mb-10">
    <label class="col-lg-3 col-form-label fw-bold fs-6" id="min_purchase_label">Minimum Total Purchase (incl. shipping) *</label>
    <div class="col-lg-9">
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" class="form-control" name="min_purchase" id="min_purchase" required min="0" step="1000"
                value="{{ old('min_purchase', $voucher->min_purchase ?? 0) }}" placeholder="0">
        </div>
        <div class="form-text text-muted" id="min_purchase_help">
            Customer cart total including shipping must reach this amount.
        </div>
    </div>
</div>

{{-- Discount Parameters Section --}}
<div class="row mb-10">
    <label class="col-lg-3 col-form-label fw-bold fs-6">Discount Type *</label>
    <div class="col-lg-9">
        <div class="form-check form-check-custom form-check-solid mb-5">
            <input class="form-check-input" type="radio" name="discount_type" id="discount_type_percent" value="percent" 
                {{ old('discount_type', $voucher->discount_type) == 'percent' || !$edit ? 'checked' : '' }} onchange="toggleDiscountFields()">
            <label class="form-check-label" for="discount_type_percent">
                Percentage Discount
            </label>
        </div>
        <div class="form-check form-check-custom form-check-solid">
            <input class="form-check-input" type="radio" name="discount_type" id="discount_type_fixed" value="fixed_amount"
                {{ old('discount_type', $voucher->discount_type) == 'fixed_amount' ? 'checked' : '' }} onchange="toggleDiscountFields()">
            <label class="form-check-label" for="discount_type_fixed">
                Fixed Amount Discount
            </label>
        </div>
    </div>
</div>

<div id="discount_rate_group" style="{{ old('discount_type', $voucher->discount_type) == 'fixed_amount' ? 'display:none;' : '' }}">
    <div class="row mb-10">
        <label class="col-lg-3 col-form-label fw-bold fs-6">Discount Rate (%)</label>
        <div class="col-lg-9">
            <div class="input-group">
                <input type="number" class="form-control" name="discount_rate" id="discount_rate" min="0" max="100" step="0.01"
                    value="{{ old('discount_rate', $voucher->discount_rate) }}" placeholder="0.00">
                <span class="input-group-text">%</span>
            </div>
        </div>
    </div>
    
    <div class="row mb-10">
        <label class="col-lg-3 col-form-label fw-bold fs-6">Maximum Discount</label>
        <div class="col-lg-9">
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control" name="discount_amount" id="discount_amount_percent" min="0" step="1000"
                    value="{{ old('discount_amount', $voucher->discount_amount) }}" placeholder="0 (no limit)">
            </div>
        </div>
    </div>
</div>

<div id="discount_amount_group" style="{{ old('discount_type', $voucher->discount_type) == 'percent' || !$edit ? 'display:none;' : '' }}">
    <div class="row mb-10">
        <label class="col-lg-3 col-form-label fw-bold fs-6">Discount Amount</label>
        <div class="col-lg-9">
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control" name="discount_amount_fixed" id="discount_amount_fixed" min="0" step="1000"
                    value="{{ old('discount_amount', $voucher->discount_amount) }}" placeholder="0">
            </div>
        </div>
    </div>
</div>

<hr>
<h3>Quotas & Status</h3>
<br>

{{-- Quotas Section --}}
<div class="row mb-10">
    <label class="col-lg-3 col-form-label fw-bold fs-6">Total Quota *</label>
    <div class="col-lg-9">
        <input type="number" class="form-control" name="quota_total" id="quota_total" required min="0"
            value="{{ old('quota_total', $voucher->quota_total ?? 0) }}" placeholder="0">
        <div class="form-text text-muted">0 = unlimited</div>
    </div>
</div>

<div class="row mb-10">
    <label class="col-lg-3 col-form-label fw-bold fs-6">Quota Per User *</label>
    <div class="col-lg-9">
        <input type="number" class="form-control" name="quota_per_user" id="quota_per_user" required min="1"
            value="{{ old('quota_per_user', $voucher->quota_per_user ?? 1) }}" placeholder="1">
    </div>
</div>

@if($edit && $voucher->usage_count > 0)
<div class="row mb-10">
    <div class="col-lg-3"></div>
    <div class="col-lg-9">
        <div class="alert alert-info">
            <strong>Usage Statistics:</strong><br>
            This voucher has been used {{ $voucher->usage_count }} time(s).
            @if($voucher->quota_total > 0)
                Remaining quota: {{ $voucher->quota_total - $voucher->usage_count }}
            @endif
        </div>
    </div>
</div>
@endif

<div class="row mb-10">
    <label class="col-lg-3 col-form-label fw-bold fs-6">Activate this voucher?</label>
    <div class="col-lg-9">
        <label class="form-check form-switch form-check-custom form-check-solid">
            <input type="hidden" name="is_active" value="0"/>
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                {{ $edit ? (intval($voucher->is_active) ? 'checked' : '') : 'checked' }} />
            <span class="form-check-label fw-bold text-muted">
                Active
            </span>
        </label>
    </div>
</div>

@push('scripts')
<script>
function updateMinPurchaseLabel() {
    const applyTo = document.querySelector('input[name="apply_to"]:checked')?.value || 'cart';
    const label = document.getElementById('min_purchase_label');
    const help = document.getElementById('min_purchase_help');

    if (applyTo === 'shipping') {
        label.textContent = 'Minimum Shipping Cost *';
        help.textContent = 'Shipping cost must reach this amount before the voucher can be used.';
    } else if (applyTo === 'product') {
        label.textContent = 'Minimum Total Product Price *';
        help.textContent = 'Product subtotal (before shipping) must reach this amount.';
    } else {
        label.textContent = 'Minimum Total Purchase (incl. shipping) *';
        help.textContent = 'Product subtotal + shipping must reach this amount.';
    }
}

function toggleDiscountFields() {
    const discountType = document.querySelector('input[name="discount_type"]:checked').value;
    const rateGroup = document.getElementById('discount_rate_group');
    const amountGroup = document.getElementById('discount_amount_group');
    const rateInput = document.getElementById('discount_rate');
    const amountFixedInput = document.getElementById('discount_amount_fixed');
    
    if (discountType === 'percent') {
        rateGroup.style.display = 'block';
        amountGroup.style.display = 'none';
        rateInput.required = true;
        amountFixedInput.required = false;
        
        // Clear fixed amount field and transfer its value to discount_amount if needed
        if (amountFixedInput.value) {
            document.getElementById('discount_amount_percent').value = amountFixedInput.value;
            amountFixedInput.value = '';
        }
        
        // Rename discount_amount field for percent type
        document.getElementById('discount_amount_percent').name = 'discount_amount';
        amountFixedInput.name = 'discount_amount_fixed';
    } else {
        rateGroup.style.display = 'none';
        amountGroup.style.display = 'block';
        rateInput.required = false;
        amountFixedInput.required = true;
        
        // Clear rate field
        rateInput.value = '';
        
        // Transfer value from percent discount_amount to fixed amount if needed
        const discountAmountPercent = document.getElementById('discount_amount_percent');
        if (discountAmountPercent.value) {
            amountFixedInput.value = discountAmountPercent.value;
            discountAmountPercent.value = '';
        }
        
        // Rename discount_amount field for fixed type
        amountFixedInput.name = 'discount_amount';
        document.getElementById('discount_amount_percent').name = 'discount_amount_percent';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleDiscountFields();
    updateMinPurchaseLabel();
});
</script>
@endpush
