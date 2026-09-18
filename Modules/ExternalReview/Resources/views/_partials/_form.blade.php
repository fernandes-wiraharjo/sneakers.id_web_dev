<x-ladmin-form-group name="buyer_name" label="Buyer Name *">
    <input type="text" placeholder="Buyer name" class="form-control" name="buyer_name" id="buyer_name" required
        value="{{ old('buyer_name', $link->buyer_name) }}">
    <div class="col-sm-12">
        <span class="text-muted fw-bold fs-6">
            This name will be shown on the review page and saved with the review.
        </span>
    </div>
</x-ladmin-form-group>

<x-ladmin-form-group name="product_id" label="Product *">
    <select class="form-select" name="product_id" id="product_id" required>
        <option value="">Select product</option>
        @foreach ($products as $product)
            <option value="{{ $product->id }}" {{ old('product_id', $link->product_id) == $product->id ? 'selected' : '' }}>
                {{ $product->product_name }} ({{ $product->product_code }})
            </option>
        @endforeach
    </select>
</x-ladmin-form-group>

<x-ladmin-form-group name="product_size" label="Size *">
    <select class="form-select" name="product_size" id="product_size" required>
        <option value="">Select product first</option>
    </select>
</x-ladmin-form-group>

@push('scripts')
<script>
    const productSelect = document.getElementById('product_id');
    const sizeSelect = document.getElementById('product_size');
    const oldSize = '{{ old('product_size', $link->product_size) }}';
    const sizesUrl = '{{ url('administrator/external-review/product-sizes') }}';

    function loadSizes(productId, selectedSize) {
        sizeSelect.innerHTML = '<option value="">Loading...</option>';
        sizeSelect.disabled = true;

        if (!productId) {
            sizeSelect.innerHTML = '<option value="">Select product first</option>';
            sizeSelect.disabled = true;
            return;
        }

        fetch(sizesUrl + '/' + productId, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(response => response.json())
            .then(data => {
                sizeSelect.innerHTML = '<option value="">Select size</option>';
                data.sizes.forEach(function (size) {
                    const option = document.createElement('option');
                    option.value = size;
                    option.textContent = size;
                    if (selectedSize && selectedSize === size) {
                        option.selected = true;
                    }
                    sizeSelect.appendChild(option);
                });
                sizeSelect.disabled = false;
            })
            .catch(function () {
                sizeSelect.innerHTML = '<option value="">Failed to load sizes</option>';
                sizeSelect.disabled = true;
            });
    }

    productSelect.addEventListener('change', function () {
        loadSizes(this.value, null);
    });

    if (productSelect.value) {
        loadSizes(productSelect.value, oldSize);
    }

    const form = document.getElementById('form');
    const validator = FormValidation.formValidation(form, {
        fields: {
            'buyer_name': {
                validators: { notEmpty: { message: 'Buyer name is required' } }
            },
            'product_id': {
                validators: { notEmpty: { message: 'Product is required' } }
            },
            'product_size': {
                validators: { notEmpty: { message: 'Size is required' } }
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: '.fv-row',
                eleInvalidClass: '',
                eleValidClass: ''
            })
        }
    });

    const submitButton = document.getElementById('form-submit');
    submitButton.addEventListener('click', function (e) {
        e.preventDefault();

        if (validator) {
            validator.validate().then(function (status) {
                if (status === 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    form.submit();
                }
            });
        }
    });
</script>
@endpush
