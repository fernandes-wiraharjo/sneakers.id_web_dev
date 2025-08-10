<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <!--begin::Input group-->
     <div style="padding: 10px 0px;">
        <!--begin::Label-->
        <label class="Heading u-h6">{{ __('PROVINCE') }}</label>
        <!--end::Label-->

        <!--begin::Input-->
            <svg class="Icon Icon--select-arrow" role="presentation" viewBox="0 0 19 12">
                <polyline fill="none" stroke="currentColor" points="17 2 9.5 10 2 2" fill-rule="evenodd"
                    stroke-width="2" stroke-linecap="square"></polyline>
            </svg>
            <select  class="Form__Input" name="province" title="Province" wire:change="updateDistrict($event.target.value)">
                <option value="">SELECT PROVINCE</option>
                @foreach ($province as $item)
                    <option value="{{$item}}" {{ $item == $selectedProvince ? 'selected' : ($userRegion != null ? ($item == $userRegion->province ? 'selected' : '') : '')}}>{{$item}}</option>
                @endforeach
            </select>
        {{-- </div> --}}
        <!--end::Input-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div style="padding: 10px 0px;">
        <!--begin::Label-->
        <label class="Heading u-h6">{{ __('DISTRICT') }}</label>
        <!--end::Label-->

        <!--begin::Input-->
        <select class="Form__Input" name="district" id="district" wire:change="updateSubdistrict($event.target.value)">
            <option value="" selected>SELECT DISTRICT</option>
            @if($district == [])
                @if($userRegion != null)
                <option value="{{ $userRegion->district }}" selected>{{ $userRegion->district }}</option>
                @endif
            @endif
            @foreach ($district as $item)
                <option value="{{$item}}" {{ $userRegion != null ? ($item == $userRegion->district ? 'selected' : '') : '' }}>{{$item}}</option>
            @endforeach
        </select>
        <!--end::Input-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div style="padding: 10px 0px;">
        <!--begin::Label-->
        <label class="Heading u-h6">{{ __('SUBDISTRICT') }}</label>
        <select class="Form__Input" name="subdistrict" id="subdistrict" wire:change="updateArea($event.target.value)">
            <option value="" selected>SELECT SUBDISTRICT</option>
            @if($subdistrict == [])
                @if($userRegion != null)
                <option value="{{ $userRegion->subdistrict }}" selected>{{ $userRegion->subdistrict }}</option>
                @endif
            @endif
            @foreach ($subdistrict as $item)
                <option value="{{$item}}" {{ $userRegion != null ? ($item == $userRegion->subdistrict ? 'selected' : '') : ''}}>{{$item}}</option>
            @endforeach
        </select>
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div style="padding: 10px 0px;">
        <!--begin::Label-->
        <label class="Heading u-h6">{{ __('AREA') }}</label>
        <!--end::Label-->

        <!--begin::Input-->
        <select class="Form__Input size-select" name="area" id="area" >
            <option value="" selected>SELECT AREA</option>
            @if($area == [])
                @if($userRegion != null)
                <option value="{{ $userRegion->area }}" selected>{{ $userRegion->area }}</option>
                @endif
            @endif
            @foreach ($area as $index=>$item)
                <option value="{{$index}}" {{ $userRegion != null ? ($index == $userRegion->area ? 'selected' : '') : '' }}>{{$item}}</option>
            @endforeach
        </select>
        <!--end::Input-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div style="padding: 10px 0px;">
        <!--begin::Label-->
        <label class="Heading u-h6">{{ __('POSTAL CODE') }}</label>
        <!--end::Label-->

        <!--begin::Input-->
        <select class="Form__Input" name="post_code" id="post_code">
            <option value="" selected>SELECT POSTAL CODE</option>
            @if($postalCode == [])
                @if($userRegion != null)
                <option value="{{ $userRegion->post_code }}" selected>{{ $userRegion->post_code }}</option>
                @else
                <option value="">Select Post Code</option>
                @endif
            @endif
            @foreach ($postalCode as $item)
                <option value="{{$item}}">{{$item}}</option>
            @endforeach
        </select>
        <!--end::Input-->
    </div>
</div>
