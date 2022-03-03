<x-ladmin-form-group name="tag_code" label="Code *">
	<input type="text" placeholder="Tag Code" class="form-control" name="tag_code" id="tag_code" required value="{{ old('tag_code', $tag->tag_code) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="tag_title" label="Title *">
	<input type="text" placeholder="Tag Title" class="form-control" name="tag_title" id="tag_title" required value="{{ old('tag_title', $tag->tag_title) }}">
</x-ladmin-form-group>

{{-- <x-ladmin-form-group name="tag_image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('tag_image', $tag->tag_image) }}">
</x-ladmin-form-group> --}}

<x-ladmin-form-group name="tag_description" label="Description *">
	<textarea placeholder="Tag Description" class="form-control" name="tag_description" id="tag_description">{{ old('tag_description', $tag->tag_description) }}</textarea>
</x-ladmin-form-group>

@include('components.is_active', ['is_active' => $tag->is_active, 'edit' => $edit])

@push('scripts')
<script>
    const form = document.getElementById('form');
    var validator = FormValidation.formValidation(
        form,
        {
            fields: {
                'tag_code': {
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
                'tag_title': {
                    validators: {
                        notEmpty: {
                            message: 'Title is required'
                        }
                    }
                },
                'tag_description': {
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
