
<select class="form-control form-select" name="signature_player_id" id="signature_player_id">
    <option value="">-- Select Signature Player --</option>
    @foreach($signatures as $signature)
        <option value="{{ $signature->id }}" {{ old('signature_player_id', $selectedSignature) == $signature->id ? 'selected' : '' }}>
            {{ $signature->value }}
        </option>
    @endforeach
</select>
