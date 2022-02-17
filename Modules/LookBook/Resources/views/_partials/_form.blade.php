<x-ladmin-form-group name="look_book_title" label="Page Title *">
	<input type="text" placeholder="Page Title" class="form-control" name="look_book_title" id="look_book_title" required value="{{ old('look_book_title', $lookbook->look_book_title) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="look_book_description" label="Title *">
	<input type="text" placeholder="Look Book Description" class="form-control" name="look_book_description" id="look_book_description" required value="{{ old('look_book_description', $lookbook->look_book_description) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="look_book_order" label="Order *">
	<input type="number" min="0" placeholder="Look Book Order" class="form-control" name="look_book_order" id="look_book_order" required value="{{ old('order', $lookbook->look_book_order) }}">
</x-ladmin-form-group>

<div class="mr-5 ml-5 mt-3 p-2 mb-10 text-center">
    @livewire('product-image', ['image' => $lookbook->images()->get('image_url')->toArray(), 'module' => 'lookbook', 'edit' => $edit])
</div>

<hr class="m-5">
<!--begin::Repeater-->
<div style="margin-left: 5%; margin-bottom: 10px ;margin-top: 10px;" id="lookbook">
    <!--begin::Form group-->
    <div class="form-group">
        <div data-repeater-list="lookbook">
            @if (!$edit || ($edit && ($lookbook->cards()->count() == 0)))
                <div data-repeater-item>
                    <div class="form-group row mb-5">
                        <div class="col-md-3">
                            @include('components.image', ['image' => '', 'module' => 'lookbook', 'edit' => false])
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row mb-5">
                                <div class="col-md-12">
                                    <label class="form-label">Title :</label>
                                    <input type="hidden" class="form-control" value="" name="look_book_card_id">
                                    <input type="text" class="form-control mb-2 mb-md-0" name="look_book_card_title" />
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Url :</label>
                                    <input type="text" class="form-control mb-2 mb-md-0" name="look_book_card_url" />
                                </div>
                                <div class="col-md-10">
                                    <label class="form-label">Description :</label>
                                    <input type="text" class="form-control mb-2 mb-md-0" name="look_book_card_description" />
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check form-check-custom form-check-solid mt-2 mt-md-11">
                                        <input class="form-check-input" type="checkbox" value="1" name="look_book_is_active" id="form_checkbox" />
                                        <label class="form-check-label" for="form_checkbox">
                                            Primary
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row mb-5">
                                <div class="col-md-12 mb-2 mb-md-0">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                        <i class="la la-trash-o"></i>Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($edit)
                @foreach ($lookbook->cards()->get() as $item)
                <div data-repeater-item>
                    <div class="form-group row mb-5">
                        <div class="col-md-3">
                            @include('components.image', ['image' => $item, 'module' => 'lookbook', 'edit' => true])
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row mb-5">
                                <div class="col-md-12">
                                    <label class="form-label">Title :</label>
                                    <input type="hidden" class="form-control" value="{{ $item->look_book_card_id }}" name="look_book_card_id">
                                    <input type="text" class="form-control mb-2 mb-md-0" name="look_book_card_title" value="{{ $item->look_book_card_title }}"/>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Url :</label>
                                    <input type="text" class="form-control mb-2 mb-md-0" name="look_book_card_url" value="{{ $item->look_book_card_url }}"/>
                                </div>
                                <div class="col-md-10">
                                    <label class="form-label">Description :</label>
                                    <input type="text" class="form-control mb-2 mb-md-0" name="look_book_card_description" value="{{ $item->look_book_card_description }}"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="is_active">
                                        Active
                                    </label>
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input form-control mb-2 mb-md-0" type="checkbox" name="is_active" value="1" id="is_active"
                                            checked="{{ $edit ? ($item->is_active ? 'checked' : '') : 'checked' }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row mb-5">
                                <div class="col-md-12 mb-2 mb-md-0">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                        <i class="la la-trash-o"></i>Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
    <hr>
    <!--end::Form group-->
    <div class="form-group mt-5">
        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
            <i class="la la-plus"></i>Add
        </a>
    </div>
</div>
<!--end::Repeater-->

<!--begin::Input group-->
<div class="fv-row mb-10">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">Look Book Content</label>
    <!--end::Label-->

    <!--begin::Input-->
    <textarea name="look_book_content" id="kt_docs_ckeditor_classic">
        {!! old('look_book_content', $lookbook->look_book_content) !!}
    </textarea>
</div>

@include('components.is_active', ['is_active' => $lookbook->is_active, 'edit' => $edit])

@push('scripts')
<!--CKEditor Build Bundles:: Only include the relevant bundles accordingly-->
<script src="{{asset('demo1/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#kt_docs_ckeditor_classic'))
        .then(editor => {

        })
        .catch(error => {

        });
</script>
<script src="{{ asset('demo1/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script>
    $('#lookbook').repeater({
    initEmpty: false,

    defaultValues: {
        'look_book_is_active': 1
    },

    show: function () {
        $(this).slideDown();

        KTImageInput.createInstances();
    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    }
});
</script>
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
                'look_book_description': {
                    validators: {
                        notEmpty: {
                            message: 'Description is required'
                        }
                    }
                },
                'look_book_content': {
                    validators: {
                        notEmpty: {
                            message: 'Content is required'
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
                            text: "Brand has been successfully submitted!",
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
