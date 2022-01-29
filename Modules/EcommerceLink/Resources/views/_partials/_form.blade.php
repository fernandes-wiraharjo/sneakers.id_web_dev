<x-ladmin-form-group name="ecommerce_code" label="Code *">
	<input type="text" placeholder="Category Code" class="form-control" name="ecommerce_code" id="ecommerce_code" required value="{{ old('ecommerce_code', $ecommerce->ecommerce_code) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="ecommerce_title" label="Title *">
	<input type="text" placeholder="Category Title" class="form-control" name="ecommerce_title" id="ecommerce_title" required value="{{ old('ecommerce_title', $ecommerce->ecommerce_title) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="ecommerce_image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('ecommerce_image', $ecommerce->ecommerce_image) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="ecommerce_description" label="Description *">
	<textarea placeholder="Category Description" class="form-control" name="ecommerce_description" id="ecommerce_description">{{ old('ecommerce_description', $ecommerce->ecommerce_description) }}</textarea>
</x-ladmin-form-group>

@include('components.is_active')

{{-- <x-ladmin-form-group name="is_active" label="Active *">
    <div class="form-check col-sm-5 ml-2">
        <input class="form-check-input" type="radio" name="is_active" id="is_active" value=1 checked>
        <label class="form-check-label" for="is_active">
          Active
        </label>
    </div>
    <div class="form-check col-sm-5">
        <input class="form-check-input" type="radio" name="is_active" id="is_active" value=0 >
        <label class="form-check-label" for="is_active">
            Not Active
        </label>
    </div>
</x-ladmin-form-group> --}}
