<x-ladmin-form-group name="address" label="Address*">
	<textarea class="form-control" aria-label="Address" name="address" id="address" rows="5">{{ old('address', $address)}}</textarea>
</x-ladmin-form-group>

<x-ladmin-form-group name="maps" label="Maps*">
	<input type="text" placeholder="Google maps url" class="form-control" name="maps" id="maps" required
        value="{{ old('maps', $maps) }}">
</x-ladmin-form-group>
