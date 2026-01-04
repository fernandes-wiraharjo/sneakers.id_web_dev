<div>
    <div class="mb-3">
        <label for="province" class="form-label fw-semibold">PROVINCE</label>
        <select class="form-select" 
                id="province" 
                name="province" 
                wire:change="updateDistrict($event.target.value)">
            <option value="">SELECT PROVINCE</option>
            @foreach ($province as $item)
                <option value="{{ $item }}" 
                        {{ $item == $selectedProvince ? 'selected' : ($userRegion != null ? ($item == $userRegion->province ? 'selected' : '') : '') }}>
                    {{ $item }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="district" class="form-label fw-semibold">DISTRICT</label>
        <select class="form-select" 
                id="district" 
                name="district" 
                wire:change="updateSubdistrict($event.target.value)">
            <option value="">SELECT DISTRICT</option>
            @if($district == [])
                @if($userRegion != null)
                    <option value="{{ $userRegion->district }}" selected>{{ $userRegion->district }}</option>
                @endif
            @endif
            @foreach ($district as $item)
                <option value="{{ $item }}" 
                        {{ $userRegion != null ? ($item == $userRegion->district ? 'selected' : '') : '' }}>
                    {{ $item }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="subdistrict" class="form-label fw-semibold">SUBDISTRICT</label>
        <select class="form-select" 
                id="subdistrict" 
                name="subdistrict" 
                wire:change="updateArea($event.target.value)">
            <option value="">SELECT SUBDISTRICT</option>
            @if($subdistrict == [])
                @if($userRegion != null)
                    <option value="{{ $userRegion->subdistrict }}" selected>{{ $userRegion->subdistrict }}</option>
                @endif
            @endif
            @foreach ($subdistrict as $item)
                <option value="{{ $item }}" 
                        {{ $userRegion != null ? ($item == $userRegion->subdistrict ? 'selected' : '') : '' }}>
                    {{ $item }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="area" class="form-label fw-semibold">AREA</label>
        <select class="form-select" 
                id="area" 
                name="area">
            <option value="">SELECT AREA</option>
            @if($area == [])
                @if($userRegion != null)
                    <option value="{{ $userRegion->area }}" selected>{{ $userRegion->area }}</option>
                @endif
            @endif
            @foreach ($area as $index => $item)
                <option value="{{ $index }}" 
                        {{ $userRegion != null ? ($index == $userRegion->area ? 'selected' : '') : '' }}>
                    {{ $item }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="post_code" class="form-label fw-semibold">POSTAL CODE</label>
        <select class="form-select" 
                id="post_code" 
                name="post_code">
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

