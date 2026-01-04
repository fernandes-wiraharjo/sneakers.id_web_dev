<div>
    <div class="mb-3">
        <label for="province" class="form-label fw-semibold">PROVINCE</label>
        <select class="form-select" 
                id="province" 
                name="province" 
                wire:model="selectedProvince"
                wire:change="updateDistrict($event.target.value)">
            <option value="">SELECT PROVINCE</option>
            @foreach ($province as $item)
                <option value="{{ $item }}">
                    {{ $item }}
                </option>
            @endforeach
        </select>
        <div wire:loading wire:target="updateDistrict" class="text-muted small mt-1">Loading districts...</div>
    </div>

    <div class="mb-3">
        <label for="district" class="form-label fw-semibold">DISTRICT</label>
        <select class="form-select" 
                id="district" 
                name="district" 
                wire:model="selectedDistrict"
                wire:change="updateSubdistrict($event.target.value)"
                wire:target="updateDistrict"
                wire:loading.attr="disabled">
            <option value="">SELECT DISTRICT</option>
            @if($district == [])
                @if($userRegion != null)
                    <option value="{{ $userRegion->district }}" selected>{{ $userRegion->district }}</option>
                @endif
            @endif
            @foreach ($district as $item)
                <option value="{{ $item }}">
                    {{ $item }}
                </option>
            @endforeach
        </select>
        <div wire:loading wire:target="updateSubdistrict" class="text-muted small mt-1">Loading subdistricts...</div>
    </div>

    <div class="mb-3">
        <label for="subdistrict" class="form-label fw-semibold">SUBDISTRICT</label>
        <select class="form-select" 
                id="subdistrict" 
                name="subdistrict" 
                wire:model="selectedSubdistrict"
                wire:change="updateArea($event.target.value)"
                wire:target="updateSubdistrict"
                wire:loading.attr="disabled">
            <option value="">SELECT SUBDISTRICT</option>
            @if($subdistrict == [])
                @if($userRegion != null)
                    <option value="{{ $userRegion->subdistrict }}" selected>{{ $userRegion->subdistrict }}</option>
                @endif
            @endif
            @foreach ($subdistrict as $item)
                <option value="{{ $item }}">
                    {{ $item }}
                </option>
            @endforeach
        </select>
        <div wire:loading wire:target="updateArea" class="text-muted small mt-1">Loading areas...</div>
    </div>

    <div class="mb-3">
        <label for="area" class="form-label fw-semibold">AREA</label>
        <select class="form-select" 
                id="area" 
                name="area"
                wire:model="selectedArea"
                wire:change="areaUpdate($event.target.value)"
                wire:target="updateArea"
                wire:loading.attr="disabled">
            <option value="">SELECT AREA</option>
            @if($area == [])
                @if($userRegion != null)
                    <option value="{{ $userRegion->region_id }}" selected>{{ $userRegion->area }}</option>
                @endif
            @endif
            @foreach ($area as $index => $item)
                <option value="{{ $index }}">
                    {{ $item }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="post_code" class="form-label fw-semibold">POSTAL CODE</label>
        <select class="form-select" 
                id="post_code" 
                name="post_code"
                wire:model="selectedPostalCode"
                wire:change="updateZipCode($event.target.value)"
                wire:target="updateArea"
                wire:loading.attr="disabled">
            <option value="">SELECT POSTAL CODE</option>
            @if($postalCode == [])
                @if($userRegion != null)
                    <option value="{{ $userRegion->post_code }}" selected>{{ $userRegion->post_code }}</option>
                @else
                    <option value="">Select Post Code</option>
                @endif
            @endif
            @foreach ($postalCode as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>
</div>

