<x-ladmin-form-group name="banner_url" label="URL *">
	<input type="text" placeholder="Banner URL" class="form-control" name="banner_url" id="banner_url" required value="{{ old('banner_url', $banner->banner_url) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="order" label="Order *">
	<input type="number" min="1" placeholder="Banner Order" class="form-control" name="order" id="order" required value="{{ old('order', $banner->order) ?? ($latest_order ?? 0) }}">
    <div class="col-sm-12">
        <span class="text-muted fw-bold fs-6">
            Order Banner only show 5 ordered banners.
        </span>
    </div>
</x-ladmin-form-group>

<x-ladmin-form-group name="banner_image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('banner_image', $banner->banner_image) }}">
    <div class="col-sm-12">
        <span class="text-muted fw-bold fs-6">
            recommended banner resolution is 720p or 1080p. make sure the image not below this resolution.
        </span>
    </div>
</x-ladmin-form-group>

<x-ladmin-form-group name="banner_description" label="Description *">
	<textarea placeholder="Banner Description" class="form-control" name="banner_description" id="banner_description">{{ old('banner_description', $banner->banner_description) }}</textarea>
</x-ladmin-form-group>

@include('components.is_active', ['is_active' => $banner->is_active, 'edit' => $edit])

@push('scripts')
<script>
    const form = document.getElementById('form');
    var validator = FormValidation.formValidation(
        form,
        {
            fields: {
                'banner_url': {
                    validators: {
                        notEmpty: {
                            message: 'URL is required'
                        },
                        uri: {
                            message : "URL not valid"
                        }
                    }
                },
                // 'image': {
                //     validators: {
                //         // notEmpty: {
                //         //     message: 'Image is required'
                //         // },
                //         file: {
                //             extension: 'jpeg,jpg,png',
                //             type: 'image/jpeg,image/png',
                //             maxSize: 2097152, // 2048 * 1024
                //             message: 'The selected file is not valid',
                //         },
                //     }
                // },
                'order': {
                    validators: {
                        notEmpty: {
                            message: 'Order is required'
                        }
                    }
                },
                'banner_description': {
                    validators: {
                        notEmpty: {
                            message: 'Description is required'
                        }
                    }
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
