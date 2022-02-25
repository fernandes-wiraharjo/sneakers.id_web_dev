<x-ladmin-form-group name="category_code" label="Code *">
	<input type="text" placeholder="Category Code" class="form-control" name="category_code" id="category_code" required value="{{ old('category_code', $category->category_code) }}" {{$edit ? 'disabled' : ''}}>
</x-ladmin-form-group>

<x-ladmin-form-group name="category_title" label="Title *">
	<input type="text" placeholder="Category Title" class="form-control" name="category_title" id="category_title" required value="{{ old('category_title', $category->category_title) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="category_image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('category_image', $category->category_image) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="category_description" label="Description *">
	<textarea placeholder="Category Description" class="form-control" name="category_description" id="category_description">{{ old('category_description', $category->category_description) }}</textarea>
</x-ladmin-form-group>

@include('components.is_active', ['is_active' => $category->is_active, 'edit' => $edit])


@push('scripts')
<script>
    const form = document.getElementById('form');
    var validator = FormValidation.formValidation(
        form,
        {
            fields: {
                'category_code': {
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
                'category_title': {
                    validators: {
                        notEmpty: {
                            message: 'Title is required'
                        }
                    }
                },
                'category_description': {
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

                        // Swal.fire({
                        //     text: "Category has been successfully submitted!",
                        //     icon: "success",
                        //     buttonsStyling: false,
                        //     confirmButtonText: "Ok, got it!",
                        //     customClass: {
                        //         confirmButton: "btn btn-primary"
                        //     }
                        // });

                        form.submit(); // Submit form
                    }, 2000);
                }
            });
        }
    });
</script>
@endpush
