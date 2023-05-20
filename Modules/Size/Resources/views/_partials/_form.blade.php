<x-ladmin-form-group name="size_code" label="Code *">
	<input type="text" placeholder="Size Code" class="form-control" name="size_code" id="size_code" required value="{{ old('size_code', $size->size_code) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="size_title" label="Title *">
	<input type="text" placeholder="Size Title" class="form-control" name="size_title" id="size_title" required value="{{ old('size_title', $size->size_title) }}">
</x-ladmin-form-group>

{{-- <x-ladmin-form-group name="size_image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('size_image', $size->size_image) }}">
</x-ladmin-form-group> --}}

<x-ladmin-form-group name="size_description" label="Description *">
	<textarea placeholder="Size Description" class="form-control" name="size_description" id="size_description">{{ old('size_description', $size->size_description) }}</textarea>
</x-ladmin-form-group>
<hr>
<h5>Size Charts</h5>
<!--begin::Repeater-->
<div style="margin-left: 10%; margin-bottom: 10px" id="size">
    <!--begin::Form group-->
    <div class="form-group">
        <div data-repeater-list="size">
                <div data-repeater-item>
                    <div class="form-group row mb-5">
                        <div class="col-md-3">
                            <label class="form-label">Name :</label>
                            <input type="hidden" class="form-control" value=" @if($edit){{ $size->charts()->count() > 0 ?
                                    ($size->charts->where('size_name', "US - Men's")->first()->id ?? "")
                                 : '' }}@endif" name="size_chart_id">
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_name" value="US - Men's" readonly/>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Value :</label>
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_value"  placeholder="Enter Size Chart Value"
                                value="@if($edit){{ ($size->charts()->count() > 0 ?
                                        ($size->charts->where('size_name', "US - Men's")->first()->size_value ?? '')
                                     : '')}}@endif"/>
                        </div>
                    </div>
                </div>
                <div data-repeater-item>
                    <div class="form-group row mb-5">
                        <div class="col-md-3">
                            <label class="form-label">Name :</label>
                            <input type="hidden" class="form-control" value="@if($edit){{ $size->charts()->count() > 0 ?
                                    ($size->charts->where('size_name', "US - Women's")->first()->id ?? "")
                                : '' }}@endif" name="size_chart_id">
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_name" value="US - Women's" readonly/>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Value :</label>
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_value"  placeholder="Enter Size Chart Value"
                            value="@if($edit){{ ($size->charts()->count() > 0 ?
                                        ($size->charts->where('size_name', "US - Women's")->first()->size_value ?? '')
                                    : '')}}@endif"/>
                        </div>
                    </div>
                </div>
                <div data-repeater-item>
                    <div class="form-group row mb-5">
                        <div class="col-md-3">
                            <label class="form-label">Name :</label>
                            <input type="hidden" class="form-control" value="@if($edit){{ $size->charts()->count() > 0 ?
                                    ($size->charts->where('size_name', "US - Kid's")->first()->id ?? "")
                                : '' }}@endif" name="size_chart_id">
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_name" value="US - Kid's" readonly/>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Value :</label>
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_value"  placeholder="Enter Size Chart Value"
                            value="@if($edit){{ ($size->charts()->count() > 0 ?
                                    ($size->charts->where('size_name', "US - Kid's")->first()->size_value ?? '')
                                : '')}} @endif"/>
                        </div>
                    </div>
                </div>
                <div data-repeater-item>
                    <div class="form-group row mb-5">
                        <div class="col-md-3">
                            <label class="form-label">Name :</label>
                            <input type="hidden" class="form-control" value="@if($edit){{ $size->charts()->count() > 0 ?
                                    ($size->charts->where('size_name', "UK")->first()->id ?? "")
                                : '' }}@endif" name="size_chart_id">
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_name" value="UK" readonly/>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Value :</label>
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_value"  placeholder="Enter Size Chart Value"
                            value="@if($edit){{ ($size->charts()->count() > 0 ?
                                ($size->charts->where('size_name', "UK")->first()->size_value ?? '')
                                : '') }}@endif"/>
                        </div>
                    </div>
                </div>
                <div data-repeater-item>
                    <div class="form-group row mb-5">
                        <div class="col-md-3">
                            <label class="form-label">Name :</label>
                            <input type="hidden" class="form-control" value="@if($edit){{ $size->charts()->count() > 0 ?
                                    ($size->charts->where('size_name', "CM")->first()->id ?? "")
                                : '' }}@endif" name="size_chart_id">
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_name" value="CM" readonly/>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Value :</label>
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_value"  placeholder="Enter Size Chart Value"
                            value="@if($edit){{ ($size->charts()->count() > 0 ?
                                    ($size->charts->where('size_name', "CM")->first()->size_value ?? '')
                                : '')}}@endif"/>
                        </div>
                    </div>
                </div>
                <div data-repeater-item>
                    <div class="form-group row mb-5">
                        <div class="col-md-3">
                            <label class="form-label">Name :</label>
                            <input type="hidden" class="form-control" value="@if($edit){{ $size->charts()->count() > 0 ?
                                    ($size->charts->where('size_name', "EU")->first()->id ?? "")
                                : '' }}@endif" name="size_chart_id">
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_name" value="EU" readonly/>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Value :</label>
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_value"  placeholder="Enter Size Chart Value"
                            value="@if($edit){{ ($size->charts()->count() > 0 ?
                                        ($size->charts->where('size_name', "EU")->first()->size_value ?? '')
                                    : '')}}@endif"/>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!--end::Form group-->
</div>
<!--end::Repeater-->

@include('back-office.components.is_active', ['is_active' => $size->is_active, 'edit' => $edit])

@push('scripts')
<script src="{{ asset('demo1/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script>
    $('#size').repeater({
    initEmpty: false,

    defaultValues: {
                'size_chart_id': ""
    },

    show: function () {
        $(this).slideDown();
    },
});
</script>
<script>
    const form = document.getElementById('form');
    var validator = FormValidation.formValidation(
        form,
        {
            fields: {
                'size_code': {
                    validators: {
                        notEmpty: {
                            message: 'Code is required'
                        },
                        regexp: {
                            regexp : /^(\d|\w|.|-)+$/,
                            message : "Code should'nt contain spaces"
                        }
                    }
                },
                'size_title': {
                    validators: {
                        notEmpty: {
                            message: 'Title is required'
                        }
                    }
                },
                'size_description': {
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
