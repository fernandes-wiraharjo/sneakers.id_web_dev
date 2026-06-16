<div>
    <input type="hidden" name="province" value="{{ $selectedProvinceName }}">
    <input type="hidden" name="city" value="{{ $selectedCityName }}">
    <input type="hidden" name="district" value="{{ $selectedDistrictName }}">
    <input type="hidden" name="subdistrict" value="{{ $selectedSubdistrictName }}">
    <input type="hidden" name="post_code" value="{{ $selectedPostalCode }}">
    <input type="hidden" name="subdistrict_ro_id" value="{{ $selectedSubdistrictId }}">

    <div class="mb-3">
        <label for="province" class="form-label fw-semibold">PROVINCE</label>
        <select class="form-select"
                id="province"
                wire:change="loadCities($event.target.value)">
            <option value="">SELECT PROVINCE</option>
            @foreach ($province as $id => $name)
                <option value="{{ $id }}" {{ (string) $selectedProvinceId === (string) $id || $selectedProvinceName === $name ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>
        <div wire:loading wire:target="loadCities" class="text-muted small mt-1">Loading cities...</div>
    </div>

    <div class="mb-3">
        <label for="city" class="form-label fw-semibold">CITY</label>
        <select class="form-select"
                id="city"
                wire:change="loadDistricts($event.target.value)"
                wire:loading.attr="disabled"
                wire:target="loadCities">
            <option value="">SELECT CITY</option>
            @foreach ($cityList as $id => $name)
                <option value="{{ $id }}" {{ (string) $selectedCityId === (string) $id || $selectedCityName === $name ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>
        <div wire:loading wire:target="loadDistricts" class="text-muted small mt-1">Loading districts...</div>
    </div>

    <div class="mb-3">
        <label for="district" class="form-label fw-semibold">DISTRICT</label>
        <select class="form-select"
                id="district"
                wire:change="loadSubdistricts($event.target.value)"
                wire:loading.attr="disabled"
                wire:target="loadDistricts">
            <option value="">SELECT DISTRICT</option>
            @foreach ($districtList as $id => $name)
                <option value="{{ $id }}" {{ (string) $selectedDistrictId === (string) $id || $selectedDistrictName === $name ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>
        <div wire:loading wire:target="loadSubdistricts" class="text-muted small mt-1">Loading subdistricts...</div>
    </div>

    <div class="mb-3">
        <label for="subdistrict" class="form-label fw-semibold">SUBDISTRICT</label>
        <select class="form-select"
                id="subdistrict"
                wire:change="selectSubdistrict($event.target.value)"
                wire:loading.attr="disabled"
                wire:target="loadSubdistricts">
            <option value="">SELECT SUBDISTRICT</option>
            @foreach ($subdistrictList as $id => $name)
                <option value="{{ $id }}" {{ (string) $selectedSubdistrictId === (string) $id || $selectedSubdistrictName === $name ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="post_code" class="form-label fw-semibold">POSTAL CODE</label>
        <input type="text"
               class="form-control"
               id="post_code"
               name="post_code_display"
               value="{{ $selectedPostalCode }}"
               readonly>
    </div>
</div>
