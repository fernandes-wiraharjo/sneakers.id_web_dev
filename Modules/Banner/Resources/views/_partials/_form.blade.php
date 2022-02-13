<x-ladmin-form-group name="banner_url" label="URL *">
	<input type="text" placeholder="Banner URL" class="form-control" name="banner_url" id="banner_url" required value="{{ old('banner_url', $banner->banner_url) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="order" label="Order *">
	<input type="number" min="0" placeholder="Banner Order" class="form-control" name="order" id="order" required value="{{ old('order', $banner->order) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="banner_image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('banner_image', $banner->banner_image) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="banner_description" label="Description *">
	<textarea placeholder="Banner Description" class="form-control" name="banner_description" id="banner_description">{{ old('banner_description', $banner->banner_description) }}</textarea>
</x-ladmin-form-group>

<x-ladmin-form-group name="is_headline" label="Banner Headline *">
    <div class="form-check col-sm-5 ml-2">
        <input class="form-check-input" type="radio" name="is_headline" id="is_headline" value=1 >
        <label class="form-check-label" for="is_headline">
            Active Headline
        </label>
    </div>
    <div class="form-check col-sm-5">
        <input class="form-check-input" type="radio" name="is_headline" id="is_headline" value=0 checked>
        <label class="form-check-label" for="is_headline">
            Not Active Headline
        </label>
    </div>
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
                'banner_image': {
                    validators: {
                        notEmpty: {
                            message: 'Image is required'
                        }
                    }
                },
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
                },
                'is_headline': {
                    validators: {
                        notEmpty: {
                            message: 'Is Active is required'
                        }
                    }
                },
                'is_active': {
                    validators: {
                        notEmpty: {
                            message: 'Is Active is required'
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

                        Swal.fire({
                            text: "Banner has been successfully submitted!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

                        form.submit(); // Submit form
                    }, 2000);
                }
            });
        }
    });
</script>
@endpush
