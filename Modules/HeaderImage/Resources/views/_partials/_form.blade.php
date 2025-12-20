<x-ladmin-form-group name="menu_parent_name" label="Menu Parent Name *">
    <select name="menu_parent_name" id="menu_parent_name" class="form-control" required>
        <option value="" disabled {{ !$edit ? 'selected' : '' }}>-- Select Menu Parent --</option>
        <option value="brand" {{ $edit && old('menu_parent_name', $header_image->menu_parent_name ?? '') == 'brand' ? 'selected' : '' }}>Brand</option>
        <option value="category" {{ $edit && old('menu_parent_name', $header_image->menu_parent_name ?? '') == 'category' ? 'selected' : '' }}>Category</option>
        <option value="signatures" {{ $edit && old('menu_parent_name', $header_image->menu_parent_name ?? '') == 'signatures' ? 'selected' : '' }}>Signature Player</option>
    </select>
</x-ladmin-form-group>

<x-ladmin-form-group name="menu_name" label="Menu Name *">
    <select name="menu_name" id="menu_name" class="form-control" required>
        <option value="" disabled {{ !$edit ? 'selected' : '' }}>-- Select Menu --</option>
        {{-- Options will be injected by JS --}}
    </select>
</x-ladmin-form-group>

<x-ladmin-form-group name="header_image" label="Image">
    <input type="file" class="form-control" name="image" id="image"
        value="{{ $edit ? old('image', $header_image->image_url) : old('image') }}">
    <div class="col-sm-12">
        <span class="text-muted fw-bold fs-6">
            banner image will be cropped to 1280x500 pixels
        </span>
    </div>
</x-ladmin-form-group>

@include('back-office.components.is_active', ['is_active' => $header_image->is_active ?? false, 'edit' => $edit])

@push('scripts')
<script>
    const form = document.getElementById('form');
    const brands = @json($brands);
    const categories = @json($categories);
    const signatures = @json($signatures);
    const parentTypeSelect = document.getElementById('menu_parent_name');
    const menuNameSelect = document.getElementById('menu_name');

    @if($edit)
        const selectedParent = @json(old('menu_parent_name', $header_image->menu_parent_name ?? ''));
        const selectedMenu = @json(old('menu_name', $header_image->menu_name ?? ''));
    @else
        const selectedParent = '';
        const selectedMenu = '';
    @endif

    function populateMenuOptions(type) {
        let options = '<option value="">-- Select Menu --</option>';
        let data = [];

        if (type === 'brand') {
            data = brands;
        } else if (type === 'category') {
            data = categories;
        } else if (type === 'signatures') {
            data = signatures;
        }

        data.forEach(item => {
            let value = item.brand_code || item.category_code || item.signature_code;
            let label = item.brand_title || item.category_title || item.signature_title;
            let selected = (value === selectedMenu) ? 'selected' : '';
            options += `<option value="${value}" ${selected}>${label}</option>`;
        });

        menuNameSelect.innerHTML = options;
    }

    parentTypeSelect.addEventListener('change', function () {
        populateMenuOptions(this.value);
    });

    // Prefill for edit mode
    if (selectedParent) {
        parentTypeSelect.value = selectedParent;
        populateMenuOptions(selectedParent);
    }

    // Form validation
    var validator = FormValidation.formValidation(form, {
        fields: {
            'menu_parent_name': { validators: { notEmpty: { message: 'Menu Parent is required' } } },
            'menu_name': { validators: { notEmpty: { message: 'Menu Name is required' } } },
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

    // Submit button handler
    const submitButton = document.getElementById('form-submit');
    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (validator) {
            validator.validate().then(function (status) {
                if (status === 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    setTimeout(() => {
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
                        form.submit();
                    }, 2000);
                }
            });
        }
    });
</script>
@endpush
