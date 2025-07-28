<x-ladmin-form-group name="faq_title" label="Title *">
	<input type="text" placeholder="Faq Title" class="form-control" name="faq_title" id="faq_title" required value="{{ old('faq_title', $faq->faq_title) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="faq_question" label="Question *">
	<textarea placeholder="Faq Question" class="form-control" name="faq_question" id="faq_question">{{ old('faq_question', $faq->faq_question) }}</textarea>
</x-ladmin-form-group>

<x-ladmin-form-group name="faq_answer" label="Description *">
	<textarea placeholder="Faq Answer" class="form-control" name="faq_answer" id="faq_answer">{{ old('faq_answer', $faq->faq_answer) }}</textarea>
</x-ladmin-form-group>

<!--begin::Input group-->
<div class="d-flex flex-stack w-lg-50 mb-5">
    <!--begin::Label-->
    <div class="me-5">
        <label class="fs-6 fw-bold form-label">Is Home Display?</label>
    </div>
    <!--end::Label-->

    <!--begin::Switch-->
    <label class="form-check form-switch form-check-custom form-check-solid fv-row">
        <input type="hidden" name="is_home" value="0"/>
        <input class="form-check-input" type="checkbox" name="is_home" value="1"
            {{ $edit ? (intval($faq->is_home) ? 'checked' : '') : 'checked' }} />
        <span class="form-check-label fw-bold text-muted">
            Active
        </span>
    </label>
    <!--end::Switch-->
</div>
<!--end::Input group-->

@push('scripts')
<script>
    const form = document.getElementById('form');
    var validator = FormValidation.formValidation(
        form,
        {
            fields: {
                'faq_title': {
                    validators: {
                        notEmpty: {
                            message: 'Title is required'
                        }
                    }
                },
                'faq_question': {
                    validators: {
                        notEmpty: {
                            message: 'Question is required'
                        }
                    }
                },
                'faq_answer': {
                    validators: {
                        notEmpty: {
                            message: 'Answer is required'
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
