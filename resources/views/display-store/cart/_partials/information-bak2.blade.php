<select name="province" id="Select5" required="" autocomplete="shipping address-level1" class="_b6uH RR8sg vYo81 RGaKd"  wire:change="updateDistrict($event.target.value)">
    @if ($selectedProvince == "")
        <option value="" {{$selectedProvince == "" ? 'selected' : '' }}>Pilih Provinsi</option>
    @endif
    @foreach ($province as $item)
        <option value="{{$item}}"
        {{-- {{ $item == $userRegion->province ? 'selected' : ''}} --}}
        >{{$item}}</option>
    @endforeach
</select>

<div wire:loading wire:target="updateDistrict">
   get data district...
</div>

<br>
<select name="district"
    id="Select4"
    required=""
    autocomplete="shipping country"
    class="_b6uH RR8sg vYo81 RGaKd"
    wire:change="updateSubdistrict($event.target.value)" wire:target="updateDistrict" wire:loading.attr="disabled">
    {{-- <option value="" wire:loading wire:target="updateDistrict">Pilih Kota / Kabupaten</option> --}}
    @if ($selectedDistrict == '')
        <option value="" {{$userRegion->district ? '' : 'selected'}}>Pilih Kota / Kabupaten</option>
    @endif

    {{-- @if($districtList == [])
        <option value="{{ $userRegion->district }}">{{ $userRegion->district }}</option>
    @endif --}}
    @foreach ($districtList as $item)
        <option value="{{$item}}" {{ $item == $userRegion->district ? 'selected' : '' }}>{{$item}}</option>
    @endforeach
</select>
<div wire:loading wire:target="updateSubdistrict">
    get data sub district...
 </div>

<select name="subdistrict"
    id="Select4"
    required=""
    autocomplete="shipping country"
    class="_b6uH RR8sg vYo81 RGaKd"
    wire:change="updateArea($event.target.value)" wire:target="updateSubdistrict" wire:loading.attr="disabled">
    {{-- <option value="" wire:loading wire:target="updateDistrict">Pilih Kota / Kabupaten</option> --}}
    @if ($selectedSubdistrict)
        <option value="" {{$userRegion->subdistrict ? '' : 'selected'}}>Pilih Kecamatan</option>
    @endif
    {{-- @if($subdistrictList == [])
        <option value="{{ $userRegion->subdistrict }}" >{{ $userRegion->subdistrict }}</option>
    @endif --}}
    @foreach ($subdistrictList as $item)
        <option value="{{$item}}" {{$item == $userRegion->subdistrict ? 'selected' : ''}}>{{$item}}</option>
    @endforeach
</select>
<div wire:loading wire:target="updateSubdistrict">
    get data sub area...
 </div>

<select name="area"
    id="Select4"
    required=""
    autocomplete="shipping country"
    class="_b6uH RR8sg vYo81 RGaKd" wire:change="areaUpdate($event.target.value)" wire:target="updateArea" wire:loading.attr="disabled">
    @if ($selectedArea == "")
        <option value="" {{$userRegion->area ? '' : 'selected'}}>Pilih Kelurahan</option>
    @endif
    {{-- @if($areaList == [])
        <option value="{{ $userRegion->region_id }}">{{ $userRegion->area }}</option>
    @endif --}}
    @foreach ($areaList as $index=>$item)
        <option value="{{$index}}" {{ $index == $userRegion->region_id ? 'selected' : '' }}>{{$item}}</option>
    @endforeach
</select>
<div wire:loading wire:target="updateSubdistrict">
    get data postcode...
 </div>

<br>
<select name="post_code" id="Select5" required="" autocomplete="shipping address-level1" class="_b6uH RR8sg vYo81 RGaKd" wire:model="shippingZipCode" wire:target="updateArea" wire:loading.attr="disabled">
    @if ($shippingZipCode == "")
        <option value="" {{$userRegion->post_code ? '' : 'selected'}}>Pilih Kodepos</option>
    @endif
    {{-- @if($postalCode == [])
        <option value="{{ $userRegion->post_code }}">{{ $userRegion->post_code }}</option>
    @endif --}}

    @foreach ($postalCode as $item)
        <option value="{{$item}}" {{ $item == $shippingZipCode ? 'selected' : ( auth()->check() ? ($item == $userRegion->post_code ? 'selected' : '') : '')}}>{{$item}}</option>
    @endforeach
</select>
userRegion : @dump($userRegion) <br>
district : @dump($districtList) <br>
subdistrict : @dump($subdistrictList) <br>
area : @dump($areaList) <br>
postalCode : @dump($postalCode) <br>
=====================================<br>
selectedProvince : @dump($selectedProvince) <br>
shippingProvince : @dump($shippingProvince) <br>
selectedDistrict : @dump($selectedDistrict) <br>
shippingDistrict : @dump($shippingDistrict) <br>
selectedSubdistrict  : @dump($selectedSubdistrict ) <br>
shippingSubDistrict : @dump($shippingSubDistrict) <br>
shippingCity : @dump($shippingCity) <br>
selectedArea : @dump($selectedArea) <br>
shippingArea : @dump($shippingArea) <br>
================================<br>
shippingZipCode : @dump($shippingZipCode) <br>
shippingCost : @dump($shippingCost) <br>
shippingWeight : @dump($shippingWeight) <br>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('loading:start', function () {
            // Show a loading spinner or do something to indicate loading state
            // For example, you can use a CSS class to display a spinner:
            document.body.classList.add('loading');
            console.log('loading:start');
        });

        Livewire.on('loading:end', function () {
            // Hide the loading spinner or revert to normal state
            // For example, you can remove the CSS class for the spinner:
            document.body.classList.remove('loading');
            console.log('loading:start');
        });
    });
</script>
