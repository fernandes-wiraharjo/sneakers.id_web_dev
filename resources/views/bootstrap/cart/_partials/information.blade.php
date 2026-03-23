<div id="step1" class="needs-validation" style="display: {{ $currentStep != 1 ? 'none' : '' }}">
    <div class="card">
        <div class="card-body">
            <form action="" method="POST" novalidate="" id="Form15">
                {{-- Contact Section --}}
                <section class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4 mb-0">Contact</h2>
                        @livewire('modal-message-checkout')
                        @if (!auth()->check())
                            <span class="text-muted small">
                                Already have an account?
                                <a href="{{ route('customer.login') }}" class="text-decoration-none"> Log in</a>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email"
                            class="form-control"
                            autocomplete="shipping email"
                            autofocus
                            value="{{ old('email', $shippingEmail) }}"
                            wire:model="shippingEmail">
                        <input type="hidden" name="current_url" value="{{ url()->current() }}" wire:model="currentUrl">
                        @error('shippingEmail') 
                            <div class="text-danger small mt-1">{{ $message }}</div> 
                        @enderror
                    </div>
                </section>

                {{-- Shipping Address Section --}}
                <section>
                    <h2 class="h4 mb-3">Shipping address</h2>
                    <div id="shippingAddressForm">
                        <div class="row g-3">
                            {{-- Country --}}
                            <div class="col-12">
                                <label for="countryName" class="form-label">Country/Region <span class="text-danger">*</span></label>
                                <select name="countryName" id="countryName" class="form-select" required autocomplete="shipping country">
                                    <option value="ID" selected>Indonesia</option>
                                </select>
                            </div>

                            {{-- First Name and Last Name --}}
                            <div class="col-md-6">
                                <label for="TextField26" class="form-label">Nama Depan</label>
                                <input 
                                    id="TextField26"
                                    name="first_name"
                                    type="text"
                                    class="form-control"
                                    autocomplete="shipping given-name"
                                    wire:model="shippingFirstName">
                                @error('shippingFirstName') 
                                    <div class="text-danger small mt-1">{{ $message }}</div> 
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="TextField27" class="form-label">Nama Belakang <span class="text-danger">*</span></label>
                                <input 
                                    id="TextField27"
                                    name="last_name"
                                    type="text"
                                    class="form-control"
                                    required
                                    autocomplete="shipping family-name"
                                    wire:model="shippingLastName">
                                @error('shippingLastName') 
                                    <div class="text-danger small mt-1">{{ $message }}</div> 
                                @enderror
                            </div>

                            {{-- Address --}}
                            <div class="col-12">
                                <label for="TextField28" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <input 
                                    id="TextField28" 
                                    name="alamat" 
                                    type="text" 
                                    class="form-control"
                                    required
                                    autocomplete="shipping address-line1"
                                    wire:model="shippingAddress">
                                @error('shippingAddress') 
                                    <div class="text-danger small mt-1">{{ $message }}</div> 
                                @enderror
                            </div>

                            {{-- Province --}}
                            <div class="col-md-6">
                                <label for="Select5" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                <select 
                                    name="province" 
                                    id="Select5" 
                                    class="form-select" 
                                    required 
                                    autocomplete="shipping address-level1"
                                    wire:change="updateDistrict($event.target.value)">
                                    @if ($selectedProvince == "")
                                        <option value="" selected>Pilih Provinsi</option>
                                    @endif
                                    @foreach ($province as $item)
                                        <option value="{{$item}}" {{ $item == $selectedProvince ? 'selected' : ''}}>{{$item}}</option>
                                    @endforeach
                                </select>
                                @error('selectedProvince') 
                                    <div class="text-danger small mt-1">{{ $message }}</div> 
                                @enderror
                            </div>

                            {{-- District --}}
                            <div class="col-md-6">
                                <label for="Select4" class="form-label">Kota / Kabupaten <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <select 
                                        name="district"
                                        id="Select4"
                                        class="form-select"
                                        required
                                        autocomplete="shipping country"
                                        wire:change="updateSubdistrict($event.target.value)" 
                                        wire:target="updateDistrict" 
                                        wire:loading.attr="disabled">
                                        @if ($selectedDistrict == '')
                                            <option value="" selected>Pilih Kota / Kabupaten</option>
                                        @endif
                                        @foreach ($districtList as $item)
                                            <option value="{{$item}}" {{ $item == $selectedDistrict ? 'selected' : '' }}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <div wire:loading wire:target="updateDistrict" class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                        <div class="spinner-border spinner-border-sm text-secondary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Subdistrict --}}
                            <div class="col-md-6">
                                <label for="subdistrict" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <select 
                                        name="subdistrict"
                                        id="subdistrict"
                                        class="form-select"
                                        required
                                        autocomplete="shipping country"
                                        wire:change="updateArea($event.target.value)" 
                                        wire:target="updateSubdistrict" 
                                        wire:loading.attr="disabled">
                                        @if ($selectedSubdistrict == 0)
                                            <option value="" selected>Pilih Kecamatan</option>
                                        @endif
                                        @foreach ($subdistrictList as $item)
                                            <option value="{{$item}}" {{$item == $shippingSubDistrict ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <div wire:loading wire:target="updateSubdistrict" class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                        <div class="spinner-border spinner-border-sm text-secondary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                @error('selectedSubdistrict') 
                                    <div class="text-danger small mt-1">{{ $message }}</div> 
                                @enderror
                            </div>

                            {{-- Area and Postal Code --}}
                            <div class="col-md-6">
                                <label for="area" class="form-label">Kelurahan <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <select 
                                        name="area"
                                        id="area"
                                        class="form-select"
                                        required
                                        autocomplete="shipping country"
                                        wire:change="areaUpdate($event.target.value)" 
                                        wire:target="areaUpdate" 
                                        wire:loading.attr="disabled">
                                        @if (!$selectedArea)
                                            <option value="" selected>Pilih Kelurahan</option>
                                        @endif
                                        @foreach ($areaList as $index=>$item)
                                            <option value="{{$index}}" {{ $index == $selectedArea ? 'selected' : '' }}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <div wire:loading wire:target="updateArea" class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                        <div class="spinner-border spinner-border-sm text-secondary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                @error('selectedArea') 
                                    <div class="text-danger small mt-1">{{ $message }}</div> 
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="post_code" class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <select 
                                        name="post_code" 
                                        id="post_code" 
                                        class="form-select" 
                                        required 
                                        autocomplete="shipping address-level1"
                                        wire:change="updateZipCode($event.target.value)"
                                        wire:target="updateArea" 
                                        wire:loading.attr="disabled">
                                        @if ($shippingZipCode == '')
                                            <option value="" selected>Pilih Kodepos</option>
                                        @endif
                                        @foreach ($postalCode as $item)
                                            <option value="{{$item}}" {{ $item == $shippingZipCode ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <div wire:loading wire:target="updateArea" class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                        <div class="spinner-border spinner-border-sm text-secondary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                @error('shippingZipCode') 
                                    <div class="text-danger small mt-1">{{ $message }}</div> 
                                @enderror
                            </div>

                            {{-- Phone Number --}}
                            <div class="col-12">
                                <label for="TextField32" class="form-label">Phone number <span class="text-danger">*</span></label>
                                <input 
                                    id="TextField32" 
                                    name="phonenumber" 
                                    type="tel" 
                                    class="form-control"
                                    required
                                    autocomplete="shipping tel"
                                    wire:model="shippingPhoneNumber">
                                @error('shippingPhoneNumber') 
                                    <div class="text-danger small mt-1">{{ $message }}</div> 
                                @enderror
                            </div>

                            {{-- Save Address Checkbox --}}
                            @if(auth()->check())
                                <div class="col-12">
                                    <div class="form-check">
                                        <input 
                                            type="checkbox"
                                            id="save_shipping_information"
                                            name="save_shipping_information"
                                            class="form-check-input"
                                            wire:model="saveAddress">
                                        <label for="save_shipping_information" class="form-check-label">
                                            Save this address for future orders
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <div>
                        <a href="{{ route('customer.cart') }}" class="btn btn-outline-secondary">
                            <span class="iconify me-2" data-icon="material-symbols:arrow-back"></span>
                            Return to cart
                        </a>
                    </div>
                    <div>
                        <button 
                            type="button"
                            class="btn btn-dark"
                            wire:click="informationStepSubmit"
                            wire:loading.attr="disabled"
                            wire:target="informationStepSubmit">
                            <span wire:loading.remove wire:target="informationStepSubmit">Continue to shipping</span>
                            <span wire:loading wire:target="informationStepSubmit">
                                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                Loading...
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

