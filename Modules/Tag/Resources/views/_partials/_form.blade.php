<x-ladmin-form-group name="tag_code" label="Code *">
	<input type="text" placeholder="Tag Code" class="form-control" name="tag_code" id="tag_code" required value="{{ old('tag_code', $tag->tag_code) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="tag_title" label="Title *">
	<input type="text" placeholder="Tag Title" class="form-control" name="tag_title" id="tag_title" required value="{{ old('tag_title', $tag->tag_title) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="tag_image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('tag_image', $tag->tag_image) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="tag_description" label="Description *">
	<textarea placeholder="Tag Description" class="form-control" name="tag_description" id="tag_description">{{ old('tag_description', $tag->tag_description) }}</textarea>
</x-ladmin-form-group>

@include('components.is_active')
