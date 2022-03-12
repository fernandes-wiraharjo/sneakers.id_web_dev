<x-ladmin-form-group name="brand_code" label="Code *">
	<input type="text" placeholder="Brand Code" class="form-control" name="brand_code" id="brand_code" required value="{{ old('brand_code', $brand->brand_code) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="brand_title" label="Title *">
	<input type="text" placeholder="Brand Title" class="form-control" name="brand_title" id="brand_title" required value="{{ old('brand_title', $brand->brand_title) }}">
</x-ladmin-form-group>

{{-- <x-ladmin-form-group name="brand_image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('brand_image', $brand->brand_image) }}">
</x-ladmin-form-group> --}}

<x-ladmin-form-group name="brand_description" label="Description *">
	<textarea placeholder="Brand Description" class="form-control" name="brand_description" id="brand_description">{{ old('brand_description', $brand->brand_description) }}</textarea>
</x-ladmin-form-group>

<!--begin::Input group-->
<div class="d-flex flex-stack w-lg-50 mb-5">
    <!--begin::Label-->
    <div class="me-5">
        <label class="fs-6 fw-bold form-label">Is menu?</label>
    </div>
    <!--end::Label-->

    <!--begin::Switch-->
    <label class="form-check form-switch form-check-custom form-check-solid fv-row">
        <input type="hidden" name="is_menu" value="0"/>
        <input class="form-check-input" type="checkbox" name="is_menu" value="1"
            {{ $edit ? (intval($brand->is_menu) ? 'checked' : '') : 'checked' }} />
        <span class="form-check-label fw-bold text-muted">
            Active
        </span>
    </label>
    <!--end::Switch-->
</div>
<!--end::Input group-->

@include('components.is_active', ['is_active' => $brand->is_active, 'edit' => $edit])

@push('scripts')
<script>
    const form = document.getElementById('form');
    var validator = FormValidation.formValidation(
        form,
        {
            fields: {
                'brand_code': {
                    validators: {
                        notEmpty: {
                            message: 'Code is required'
                        },
                        regexp: {
                            regexp : /^(\d|\w|-)+$/,
                            message : "Code should'nt contain spaces"
                        }
                    }
                },
                'brand_title': {
                    validators: {
                        notEmpty: {
                            message: 'Title is required'
                        }
                    }
                },
                'brand_description': {
                    validators: {
                        notEmpty: {
                            message: 'Description is required'
                        }
                    }
                },
            },

            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: '.fv-row',
                    eleInvalidClass: '',
                    eleValidClass: ''
                })
            }
        }
    );

    // Submit button handler
    const submitButton = document.getElementById('form-submit');
    submitButton.addEventListener('click', function (e) {
        e.preventDefault();

        if (validator) {
            validator.validate().then(function (status) {
                console.log('validated!');

                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;

                    setTimeout(function () {
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;

                        form.submit(); // Submit form
                    }, 2000);
                }
            });
        }
    });
</script>
@endpush
