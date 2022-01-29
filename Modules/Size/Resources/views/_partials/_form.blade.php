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

@include('components.is_active')
