<x-ladmin-form-group name="setting_type" label="Type *">
	<input type="text" placeholder="Setting Type" class="form-control" name="setting_type" id="setting_type" required value="{{ old('setting_type', $setting->setting_type) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="setting_code" label="Code *">
	<input type="text" placeholder="Setting Code" class="form-control" name="setting_code" id="setting_code" required value="{{ old('setting_code', $setting->setting_code) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="setting_value" label="Value *">
	<input type="text" placeholder="Setting Value" class="form-control" name="setting_value" id="setting_value" required value="{{ old('setting_value', $setting->setting_value) }}">
    <div class="col-sm-12">
         <span class="text-muted fw-bold fs-6">
            existing value will be replaced with new image below
         </span>
    </div>
</x-ladmin-form-group>

<x-ladmin-form-group name="setting_image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('setting_image', $setting->brand_image) }}">
    <div class="col-sm-12">
        <span class="text-muted fw-bold fs-6">
            no resize available on this function, please use proper image resolution for each global settings
        </span>
    </div>
</x-ladmin-form-group>

@include('back-office.components.is_active', ['is_active' => $setting->is_active, 'edit' => $edit])

@push('scripts')
<script>
    const form = document.getElementById('form');
    var validator = FormValidation.formValidation(
        form,
        {
            fields: {
                'setting_type': {
                    validators: {
                        notEmpty: {
                            message: 'Type is required'
                        }
                    }
                },
                'setting_code': {
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
                'setting_value': {
                    validators: {
                        notEmpty: {
                            message: 'Value is required'
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

    document.addEventListener("DOMContentLoaded", function () {
        const imageInput = document.getElementById("image");
        const valueInput = document.getElementById("setting_value");

        imageInput.addEventListener("change", function (e) {
            const file = e.target.files[0];

            if (file) {
                // Create a local temporary URL for preview (you can replace with actual uploaded URL)
                const imageUrl = URL.createObjectURL(file);

                // Disable the value input
                valueInput.disabled = true;

                // Set the value to the image URL (preview)
                valueInput.value = imageUrl;
            } else {
                // Re-enable if image is removed
                valueInput.disabled = false;
                valueInput.value = '';
            }
        });
    });
</script>
@endpush
