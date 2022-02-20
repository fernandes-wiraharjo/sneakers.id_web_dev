<x-ladmin-form-group name="address" label="Address*">
	<textarea class="form-control" aria-label="Address" name="address" id="address" rows="5">{{ old('address', $address ?? '')}}</textarea>
</x-ladmin-form-group>

<x-ladmin-form-group name="maps" label="Maps*">
	<input type="text" placeholder="Google maps url" class="form-control" name="maps" id="maps" required
        value="{{ old('maps', $maps ?? '') }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="phone_number_1" label="Phone Number 1*">
	<input type="text" placeholder="Phone Number 1" class="form-control" name="phone_number_1" id="phone_number_1" required
        value="{{ old('phone_number_1', $phone_number_1 ?? '') }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="phone_number_2" label="Phone Number 2*">
	<input type="text" placeholder="Phone Number 2" class="form-control" name="phone_number_2" id="phone_number_2" required
        value="{{ old('phone_number_2', $phone_number_2 ?? '') }}">
</x-ladmin-form-group>