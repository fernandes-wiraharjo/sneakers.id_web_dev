<x-ladmin-form-group name="address" label="Address*">
	<textarea class="form-control" aria-label="Address" name="address" id="address" rows="5">{{ old('address', $footer->address ?? '')}}</textarea>
</x-ladmin-form-group>

<x-ladmin-form-group name="maps" label="Maps*">
	<input type="text" placeholder="Google maps url" class="form-control" name="maps" id="maps" required
        value="{{ old('maps', $footer->maps ?? '') }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="phone_number_1" label="Phone Number 1*">
	<input type="text" placeholder="Phone Number 1" class="form-control" name="phone_number_1" id="phone_number_1" required
        value="{{ old('phone_number_1', $footer->phone_number_1 ?? '') }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="phone_number_2" label="Phone Number 2*">
	<input type="text" placeholder="Phone Number 2" class="form-control" name="phone_number_2" id="phone_number_2" required
        value="{{ old('phone_number_2', $footer->phone_number_2 ?? '') }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="email" label="Email*">
	<input type="text" placeholder="Email" class="form-control" name="email" id="email" required
        value="{{ old('email', $footer->email ?? '') }}">
</x-ladmin-form-group>