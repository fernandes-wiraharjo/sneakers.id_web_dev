<x-ladmin-form-group name="id" label="ID *">
	<input type="text" placeholder="Category ID (lowercase)" class="form-control" name="id" id="category_id" required value="{{ old('id', $blogCategory->id) }}">
	<span class="text-muted">ID must be lowercase and unique (e.g., promo, news, tips)</span>
</x-ladmin-form-group>

<x-ladmin-form-group name="name" label="Name *">
	<input type="text" placeholder="Category Name" class="form-control" name="name" id="name" required value="{{ old('name', $blogCategory->name) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="sequence" label="Sequence (Home) *">
	<input type="number" placeholder="Sequence" class="form-control" name="sequence" id="sequence" required value="{{ old('sequence', $blogCategory->sequence ?? 0) }}" min="0">
</x-ladmin-form-group>

<!--begin::Input group-->
<div class="d-flex flex-stack w-lg-50 mb-5">
    <!--begin::Label-->
    <div class="me-5">
        <label class="fs-6 fw-bold form-label">Show on Home?</label>
    </div>
    <!--end::Label-->

    <!--begin::Switch-->
    <label class="form-check form-switch form-check-custom form-check-solid fv-row">
        <input type="hidden" name="is_show_home" value="0"/>
        <input class="form-check-input" type="checkbox" name="is_show_home" value="1"
            {{ $edit ? (intval($blogCategory->is_show_home) ? 'checked' : '') : '' }} />
        <span class="form-check-label fw-bold text-muted">
            Active
        </span>
    </label>
    <!--end::Switch-->
</div>
<!--end::Input group-->

<x-ladmin-form-group name="sequence_single_post" label="Sequence (Single Post) *">
	<input type="number" placeholder="Sequence Single Post" class="form-control" name="sequence_single_post" id="sequence_single_post" required value="{{ old('sequence_single_post', $blogCategory->sequence_single_post ?? 0) }}" min="0">
</x-ladmin-form-group>

<!--begin::Input group-->
<div class="d-flex flex-stack w-lg-50 mb-5">
    <!--begin::Label-->
    <div class="me-5">
        <label class="fs-6 fw-bold form-label">Show on Single Post?</label>
    </div>
    <!--end::Label-->

    <!--begin::Switch-->
    <label class="form-check form-switch form-check-custom form-check-solid fv-row">
        <input type="hidden" name="is_show_single_post" value="0"/>
        <input class="form-check-input" type="checkbox" name="is_show_single_post" value="1"
            {{ $edit ? (intval($blogCategory->is_show_single_post) ? 'checked' : '') : 'checked' }} />
        <span class="form-check-label fw-bold text-muted">
            Active
        </span>
    </label>
    <!--end::Switch-->
</div>
<!--end::Input group-->

<x-ladmin-form-group name="sequence_search" label="Sequence (Search) *">
	<input type="number" placeholder="Sequence Search" class="form-control" name="sequence_search" id="sequence_search" required value="{{ old('sequence_search', $blogCategory->sequence_search ?? 0) }}" min="0">
</x-ladmin-form-group>

<!--begin::Input group-->
<div class="d-flex flex-stack w-lg-50 mb-5">
    <!--begin::Label-->
    <div class="me-5">
        <label class="fs-6 fw-bold form-label">Show on Search?</label>
    </div>
    <!--end::Label-->

    <!--begin::Switch-->
    <label class="form-check form-switch form-check-custom form-check-solid fv-row">
        <input type="hidden" name="is_show_search" value="0"/>
        <input class="form-check-input" type="checkbox" name="is_show_search" value="1"
            {{ $edit ? (intval($blogCategory->is_show_search) ? 'checked' : '') : 'checked' }} />
        <span class="form-check-label fw-bold text-muted">
            Active
        </span>
    </label>
    <!--end::Switch-->
</div>
<!--end::Input group-->

@push('scripts')
<script>
    // Make ID lowercase on input
    const categoryIdInput = document.getElementById('category_id');
    if (categoryIdInput) {
        categoryIdInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.toLowerCase();
        });
        
        // Also handle paste events
        categoryIdInput.addEventListener('paste', function(e) {
            setTimeout(() => {
                e.target.value = e.target.value.toLowerCase();
            }, 0);
        });
    }

    const form = document.getElementById('form');
    var validator = FormValidation.formValidation(
        form,
        {
            fields: {
                'id': {
                    validators: {
                        notEmpty: {
                            message: 'ID is required'
                        },
                        regexp: {
                            regexp : /^[a-z0-9_-]+$/,
                            message : "ID should only contain lowercase letters, numbers, hyphens, and underscores"
                        }
                    }
                },
                'name': {
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        }
                    }
                },
                'sequence': {
                    validators: {
                        notEmpty: {
                            message: 'Sequence is required'
                        },
                        integer: {
                            message: 'Sequence must be a number'
                        }
                    }
                },
                'sequence_single_post': {
                    validators: {
                        notEmpty: {
                            message: 'Sequence Single Post is required'
                        },
                        integer: {
                            message: 'Sequence Single Post must be a number'
                        }
                    }
                },
                'sequence_search': {
                    validators: {
                        notEmpty: {
                            message: 'Sequence Search is required'
                        },
                        integer: {
                            message: 'Sequence Search must be a number'
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

