<x-ladmin-form-group name="signature_code" label="Code *">
	<input type="text" placeholder="Signature Player Code" class="form-control" name="signature_code" id="signature_code" required value="{{ old('signature_code', $signature->signature_code) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="signature_title" label="Title *">
	<input type="text" placeholder="Signature Player Title" class="form-control" name="signature_title" id="signature_title" required value="{{ old('signature_title', $signature->signature_title) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="signature_player_name" label="PLayer Name *">
	<input type="text" placeholder="Signature Player Name" class="form-control" name="signature_player_name" id="signature_player_name" required value="{{ old('signature_player_name', $signature->signature_player_name) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="signature_image" label="Image">
	<input type="file" class="form-control" name="image" id="image" value="{{ old('signature_image', $signature->signature_image) }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="signature_description" label="Description *">
	<textarea placeholder="Signature Player Description" class="form-control" name="signature_description" id="signature_description">{{ old('signature_description', $signature->signature_description) }}</textarea>
</x-ladmin-form-group>

@include('components.is_active')
