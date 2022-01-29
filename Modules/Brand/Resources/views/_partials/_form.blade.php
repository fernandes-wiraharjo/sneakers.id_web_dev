<x-ladmin-form-group name="brand_code" label="Code *">
	<input type="text" placeholder="Brand Code" class="form-control" name="brand_code" id="brand_code" required value="{{ old('brand_code', $brand->brand_code) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="brand_title" label="Title *">
	<input type="text" placeholder="Brand Title" class="form-control" name="brand_title" id="brand_title" required value="{{ old('brand_title', $brand->brand_title) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="brand_image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('brand_image', $brand->brand_image) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="brand_description" label="Description *">
	<textarea placeholder="Brand Description" class="form-control" name="brand_description" id="brand_description">{{ old('brand_description', $brand->brand_description) }}</textarea>
</x-ladmin-form-group>

@include('components.is_active')
