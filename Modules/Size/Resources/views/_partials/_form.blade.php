<x-ladmin-form-group name="size_code" label="Code *">
	<input type="text" placeholder="Size Code" class="form-control" name="size_code" id="size_code" required value="{{ old('size_code', $size->size_code) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="size_title" label="Title *">
	<input type="text" placeholder="Size Title" class="form-control" name="size_title" id="size_title" required value="{{ old('size_title', $size->size_title) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="size_image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('size_image', $size->size_image) }}">
</x-ladmin-form-group>

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
            @if ($edit)
                @foreach ($size->charts()->get() as $item)

                <div data-repeater-item>
                    <div class="form-group row mb-5">
                        <div class="col-md-3">
                            <label class="form-label">Name :</label>
                            <input type="hidden" class="form-control" value="{{$item->id}}" name="size_chart_id">
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_name"
                            value="{{ $item->size_name }}" placeholder="Enter Size Chart Name" />
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Value :</label>
                            <input type="text" class="form-control mb-2 mb-md-0" name="size_value"
                            value="{{ $item->size_value }}" placeholder="Enter Size Chart Value" />
                        </div>
                        <div class="col-md-4">
                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                <i class="la la-trash-o"></i>Delete
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <div class="form-group row mb-5">
                <div class="col-md-3">
                    <label class="form-label">Name :</label>
                    <input type="text" class="form-control mb-2 mb-md-0" name="size_name" placeholder="Enter Size Chart Name" />
                </div>
                <div class="col-md-3">
                    <label class="form-label">Value :</label>
                    <input type="text" class="form-control mb-2 mb-md-0" name="size_value"  placeholder="Enter Size Chart Value" />
                </div>
                <div class="col-md-4">
                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                        <i class="la la-trash-o"></i>Delete
                    </a>
                </div>
            </div>
            @endif

        </div>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group mt-5">
        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
            <i class="la la-plus"></i>Add
        </a>
    </div>
    <!--end::Form group-->
</div>
<!--end::Repeater-->

@include('components.is_active', ['is_active' => $size->is_active, 'edit' => $edit])

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

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    }
});
</script>
@endpush
