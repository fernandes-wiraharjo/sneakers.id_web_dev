<x-ladmin-form-group name="look_book_title" label="Page Title *">
	<input type="text" placeholder="Page Title" class="form-control" name="look_book_title" id="look_book_title" required value="{{ old('look_book_title', $lookbook->look_book_title) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="look_book_order" label="Order *">
	<input type="number" min="1" placeholder="Look Book Order" class="form-control" name="look_book_order" id="look_book_order" required value="{{ old('look_book_order', $lookbook->look_book_order) ?? ($latest_order ?? 0) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('image', $lookbook->look_book_image) }}">
</x-ladmin-form-group>

@include('components.is_active', ['is_active' => $lookbook->is_active, 'edit' => $edit])

@push('scripts')
<script>
    const form = document.getElementById('form');
    var validator = FormValidation.formValidation(
        form,
        {
            fields: {
                'look_book_title': {
                    validators: {
                        notEmpty: {
                            message: 'Title is required'
                        }
                    }
                },
                'look_book_image': {
                    validators: {
                        // notEmpty: {
                        //     message: 'Image is required'
                        // },
                        file: {
                            extension: 'jpeg,jpg,png',
                            type: 'image/jpeg,image/png',
                            maxSize: 2097152, // 2048 * 1024
                            message: 'The selected file is not valid',
                        },
                    }
                },
                'look_book_order': {
                    validators: {
                        notEmpty: {
                            message: 'Order is required'
                        }
                    }
                },
                'look_book_description': {
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
