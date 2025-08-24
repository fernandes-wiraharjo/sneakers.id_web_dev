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
@if ($edit)
    <input type="hidden" name="men_sizes_id" value="{{ $size->mens->id ?? '' }}">
    <input type="hidden" name="women_sizes_id" value="{{ $size->womens->id ?? '' }}">
    <input type="hidden" name="kid_sizes_id" value="{{ $size->kids->id ?? '' }}">
@endif
<div class="row pb-10">
    <div class="col-md-4">
        <h5 class="text-center pb-5">Men's Size</h5>
        <div class="input-group rounded mb-5">
            <span class="input-group-text w-50">US </span>
            <input type="text" placeholder="US Size" class="form-control mr-lg-10" name="men[US]" id="US" required value="{{ old('US',  $edit ? ($size->mens->US ?? '') : '') }}">
        </div>
        <div class="input-group rounded mb-5">
            <span class="input-group-text w-50">UK </span>
            <input type="text" placeholder="UK Size" class="form-control mr-lg-10" name="men[UK]" id="UK" required value="{{ old('UK',$edit ? ($size->mens->UK ?? '') : '') }}">
        </div>
        <div class="input-group rounded mb-5">
            <span class="input-group-text w-50">EU </span>
            <input type="text" placeholder="EU Size" class="form-control mr-lg-10" name="men[EU]" id="EU" required value="{{ old('EU', $edit ? ($size->mens->EU ?? '') : '') }}">
        </div>
        <div class="input-group rounded mb-5">
            <span class="input-group-text w-50">CM </span>
            <input type="text" placeholder="CM Size" class="form-control mr-lg-10" name="men[CM]" id="CM" required value="{{ old('CM', $edit ? ($size->mens->CM ?? '') : '') }}">
        </div>

    </div>

    <div class="col-md-4">
        <h5 class="text-center pb-5">Women's Size</h5>
        <div class="input-group rounded mb-5">
            <span class="input-group-text w-50">US</span>
            <input type="text" placeholder="US Size" class="form-control mr-lg-10" name="women[US]" id="US" required value="{{ old('US', $edit ? ($size->womens->US ?? '') : '') }}">
        </div>
        <div class="input-group rounded mb-5">
            <span class="input-group-text w-50">UK</span>
            <input type="text" placeholder="UK Size" class="form-control mr-lg-10" name="women[UK]" id="UK" required value="{{ old('UK', $edit ? ($size->womens->UK ?? '') : '') }}">
        </div>
        <div class="input-group rounded mb-5">
            <span class="input-group-text w-50">EU</span>
            <input type="text" placeholder="EU Size" class="form-control mr-lg-10" name="women[EU]" id="EU" required value="{{ old('EU', $edit ? ($size->womens->EU ?? '') : '') }}">
        </div>
        <div class="input-group rounded mb-5">
            <span class="input-group-text w-50">CM</span>
            <input type="text" placeholder="CM Size" class="form-control mr-lg-10" name="women[CM]" id="CM" required value="{{ old('CM', $edit ? ($size->womens->CM ?? '') : '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <h5 class="text-center pb-5">Kid's Size</h5>
        <div class="input-group rounded mb-5">
            <span class="input-group-text w-50">US</span>
            <input type="text" placeholder="US Size" class="form-control mr-lg-10" name="kid[US]" id="US" required value="{{ old('US', $edit ? ($size->kids->US ?? '') : '') }}">
        </div>
        <div class="input-group rounded mb-5">
            <span class="input-group-text w-50">UK</span>
            <input type="text" placeholder="UK Size" class="form-control mr-lg-10" name="kid[UK]" id="UK" required value="{{ old('UK', $edit ? ($size->kids->UK ?? '') : '') }}">
        </div>
        <div class="input-group rounded mb-5">
            <span class="input-group-text w-50">EU</span>
            <input type="text" placeholder="EU Size" class="form-control mr-lg-10" name="kid[EU]" id="EU" required value="{{ old('EU', $edit ? ($size->kids->EU ?? '') : '') }}">
        </div>
        <div class="input-group rounded mb-5">
            <span class="input-group-text w-50">CM</span>
            <input type="text" placeholder="CM Size" class="form-control mr-lg-10" name="kid[CM]" id="CM" required value="{{ old('CM', $edit ? ($size->kids->CM ?? '') : '') }}">
        </div>
    </div>
</div>

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
