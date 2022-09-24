<x-ladmin-form-group name="address" label="Address*">
	<textarea class="form-control" aria-label="Address" name="address" id="address" rows="5">{{ old('address', $footer->address ?? '')}}</textarea>
</x-ladmin-form-group>

<x-ladmin-form-group name="maps" label="Maps*">
	<input type="text" placeholder="Google maps url" class="form-control" name="maps" id="maps"
        value="{{ old('maps', $footer->maps ?? '') }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="phone_number_1" label="Phone Number 1*">
	<input type="text" placeholder="Phone Number 1" class="form-control" name="phone_number_1" id="phone_number_1"
        value="{{ old('phone_number_1', $footer->phone_number_1 ?? '') }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="phone_number_2" label="Phone Number 2*">
	<input type="text" placeholder="Phone Number 2" class="form-control" name="phone_number_2" id="phone_number_2"
        value="{{ old('phone_number_2', $footer->phone_number_2 ?? '') }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="email" label="Email*">
	<input type="text" placeholder="Email" class="form-control" name="email" id="email" required
        value="{{ old('email', $footer->email ?? '') }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="wa" label="Whatsapp*">
	<input type="text" placeholder="Whatsapp" class="form-control" name="wa" id="wa" required
        value="{{ old('wa', $footer->wa ?? '') }}">
</x-ladmin-form-group>

<x-ladmin-form-group name="line" label="Line*">
	<input type="text" placeholder="Line" class="form-control" name="line" id="line"
        value="{{ old('line', $footer->line ?? '') }}">
</x-ladmin-form-group>
