<x-ladmin-form-group name="signature_code" label="Code *">
	<input type="text" placeholder="Signature Player Code" class="form-control" name="signature_code" id="signature_code" required value="{{ old('signature_code', $signature->signature_code) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="signature_title" label="Title *">
	<input type="text" placeholder="Signature Player Title" class="form-control" name="signature_title" id="signature_title" required value="{{ old('signature_title', $signature->signature_title) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="signature_player_name" label="PLayer Name *">
	<input type="text" placeholder="Signature Player Name" class="form-control" name="signature_player_name" id="signature_player_name" required value="{{ old('signature_player_name', $signature->signature_player_name) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="signature_image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('signature_image', $signature->signature_image) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="signature_description" label="Description *">
	<textarea placeholder="Signature Player Description" class="form-control" name="signature_description" id="signature_description">{{ old('signature_description', $signature->signature_description) }}</textarea>
</x-ladmin-form-group>

@include('components.is_active', ['is_active' => $signature->is_active, 'edit' => $edit])

@push('scripts')
<script>
    const form = document.getElementById('form');
    var validator = FormValidation.formValidation(
        form,
        {
            fields: {
                'signature_code': {
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
                'signature_title': {
                    validators: {
                        notEmpty: {
                            message: 'Title is required'
                        }
                    }
                },
                'signature_player_name': {
                    validators: {
                        notEmpty: {
                            message: 'Player name is required'
                        }
                    }
                },
                'signature_description': {
                    validators: {
                        notEmpty: {
                            message: 'Description is required'
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
                            text: "Signature Player has been successfully submitted!",
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
