<div id="step1" class="needs-validation" style="display: {{ $currentStep != 1 ? 'none' : '' }}">
    <div class="card">
        <div class="card-body">
            <form action="" method="POST" novalidate="" id="Form15">
                <section aria-label="Contact" class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 id="step-section-primary-header">Contact</h2>
                        @livewire('modal-message-checkout')
                        @if (!auth()->check())
                        <span>
                            Already have an account?
                            <a class="fw-bold" href="{{ route('customer.login') }}"> Log in</a>
                        </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label id="email-label" for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="text"
                            aria-labelledby="email-label"
                            autocomplete="shipping email"
                            autofocus="true"
                            class="form-control"
                            value="{{ old('email',  $shippingEmail) }}"
                            wire:model="shippingEmail">
                        <input type="hidden" name="current_url" value="{{ url()->current() }}" wire:model="currentUrl">
                        @error('shippingEmail') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </section>

                <section aria-label="Shipping address">
                    <h2 class="mb-3">Shipping address</h2>
                    <div id="shippingAddressForm">
                        <input type="hidden" name="countryName" value="ID" autocomplete="shipping country">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label id="TextField26-label" for="TextField26" class="form-label">Nama Depan</label>
                                <input id="TextField26" name="first_name" type="text"
                                    aria-required="false"
                                    aria-labelledby="TextField26-label"
                                    autocomplete="shipping given-name"
                                    class="form-control"
                                    wire:model="shippingFirstName">
                                @error('shippingFirstName') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label id="TextField27-label" for="TextField27" class="form-label">Nama Belakang</label>
                                <input id="TextField27" name="last_name" required="" type="text"
                                    aria-required="true"
                                    aria-labelledby="TextField27-label"
                                    autocomplete="shipping family-name"
                                    class="form-control"
                                    wire:model="shippingLastName">
                                @error('shippingLastName') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label id="TextField28-label" for="TextField28" class="form-label">Alamat</label>
                                <textarea id="TextField28" name="alamat" required="" rows="3"
                                    aria-required="true"
                                    aria-labelledby="TextField28-label"
                                    autocomplete="shipping address-line1"
                                    class="form-control"
                                    wire:model="shippingAddress"></textarea>
                                @error('shippingAddress') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Select5" class="form-label">Provinsi</label>
                                <div class="position-relative">
                                    <select name="province" id="Select5" required="" autocomplete="shipping address-level1" class="form-select" wire:change="updateDistrict($event.target.value)">
                                        @if ($selectedProvince == "")
                                            <option value="" {{$selectedProvince == "" ? 'selected' : '' }}>Pilih Provinsi</option>
                                        @endif
                                        @foreach ($province as $item)
                                            <option value="{{$item}}" {{ $item == $selectedProvince ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <div wire:loading wire:target="updateDistrict" class="position-absolute top-50 end-0 translate-middle-y me-2">
                                        <div class="spinner-border spinner-border-sm" role="status"></div>
                                    </div>
                                </div>
                                @error('selectedProvince') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="Select4" class="form-label">Kota / Kabupaten</label>
                                <div class="position-relative">
                                    <select name="district" id="Select4" required="" autocomplete="shipping country" class="form-select" wire:change="updateSubdistrict($event.target.value)" wire:target="updateDistrict" wire:loading.attr="disabled">
                                        @if ($selectedDistrict == '')
                                            <option value="" {{$selectedDistrict ? '' : 'selected'}}>Pilih Kota / Kabupaten</option>
                                        @endif
                                        @foreach ($districtList as $item)
                                            <option value="{{$item}}" {{ $item == $selectedDistrict ? 'selected' : '' }}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <div wire:loading wire:target="updateSubdistrict" class="position-absolute top-50 end-0 translate-middle-y me-2">
                                        <div class="spinner-border spinner-border-sm" role="status"></div>
                                    </div>
                                </div>
                                @error('selectedDistrict') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Select4" class="form-label">Kecamatan</label>
                                <div class="position-relative">
                                    <select name="subdistrict" id="Select4" required="" autocomplete="shipping country" class="form-select" wire:change="updateArea($event.target.value)" wire:target="updateSubdistrict" wire:loading.attr="disabled">
                                        @if ($selectedSubdistrict == 0)
                                            <option value="" {{$selectedSubdistrict ? '' : 'selected'}}>Pilih Kecamatan</option>
                                        @endif
                                        @foreach ($subdistrictList as $item)
                                            <option value="{{$item}}" {{$item == $shippingSubDistrict ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <div wire:loading wire:target="updateSubdistrict" class="position-absolute top-50 end-0 translate-middle-y me-2">
                                        <div class="spinner-border spinner-border-sm" role="status"></div>
                                    </div>
                                </div>
                                @error('selectedSubdistrict') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="Select4" class="form-label">Kelurahan</label>
                                <div class="position-relative">
                                    <select name="area" id="Select4" required="" autocomplete="shipping country" class="form-select" wire:change="areaUpdate($event.target.value)" wire:target="areaUpdate" wire:loading.attr="disabled">
                                        @if (!$selectedArea)
                                            <option value="" {{$selectedArea ? '' : 'selected'}}>Pilih Kelurahan</option>
                                        @endif
                                        @foreach ($areaList as $index=>$item)
                                            <option value="{{$index}}" {{ $index == $selectedArea ? 'selected' : '' }}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <div wire:loading wire:target="updateArea" class="position-absolute top-50 end-0 translate-middle-y me-2">
                                        <div class="spinner-border spinner-border-sm" role="status"></div>
                                    </div>
                                </div>
                                @error('selectedArea') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Select5" class="form-label">Kode Pos</label>
                                <div class="position-relative">
                                    <select name="post_code" id="Select5" required="" autocomplete="shipping address-level1" class="form-select" wire:change="updateZipCode($event.target.value)" wire:target="updateArea" wire:loading.attr="disabled">
                                        @if ($shippingZipCode == '')
                                            <option value="" {{ $shippingZipCode != '' ? '' : 'selected'}}>Pilih Kodepos</option>
                                        @endif
                                        @foreach ($postalCode as $item)
                                            <option value="{{$item}}" {{ $item == $shippingZipCode ? 'selected' : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <div wire:loading wire:target="updateArea" class="position-absolute top-50 end-0 translate-middle-y me-2">
                                        <div class="spinner-border spinner-border-sm" role="status"></div>
                                    </div>
                                </div>
                                @error('shippingZipCode') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label id="TextField32-label" for="TextField32" class="form-label">Phone number</label>
                                <input id="TextField32" name="phonenumber" required="" type="tel"
                                    aria-required="true"
                                    aria-labelledby="TextField32-label"
                                    autocomplete="shipping tel"
                                    class="form-control"
                                    wire:model="shippingPhoneNumber">
                                @error('shippingPhoneNumber') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        @if(auth()->check())
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="save_shipping_information" name="save_shipping_information" wire:model="saveAddress" class="form-check-input">
                                <label for="save_shipping_information" class="form-check-label">
                                    Save this address for future orders
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>
                </section>

                <div class="d-flex gap-2 justify-content-between mt-4">
                    <a href="{{ route('customer.cart') }}" class="btn btn-outline-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" style="width: 16px; height: 16px; display: inline-block; margin-right: 8px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.4 11.9 3.748 7.248a.35.35 0 0 1 0-.495L8.4 2.1"></path>
                        </svg>
                        Return to cart
                    </a>
                    <button type="button" class="btn btn-dark" wire:click="informationStepSubmit" wire:loading.attr="disabled" wire:target="informationStepSubmit">
                        <span wire:loading.remove>Continue to shipping</span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                            Loading...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

