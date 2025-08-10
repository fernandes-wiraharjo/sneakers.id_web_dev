<div id="step1" class="needs-validation" style="display: {{ $currentStep != 1 ? 'none' : '' }}">
    <div class="I_61l">
        <div class="tAyc6">
            <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1o _1fragem25">
                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1z _1fragem2g">
                    <main id="checkout-main">
                        <form action="" method="POST" novalidate="" id="Form15"
                            class="_1fragem16">
                            <div class="_1fragemaf">
                                <div>
                                    <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1w _1fragem2d">
                                    </div>
                                    <div class="VheJw">
                                        <div class="s_qAq">
                                            <section aria-label="Contact" class="_1fragem15 _1fragemaf">
                                                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1o _1fragem25">
                                                    <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                                                        <h2 id="step-section-primary-header" class="n8k95w1 _1fragemaf n8k95w3">
                                                            Contact</h2>
                                                            @livewire('modal-message-checkout')
                                                            @if (!auth()->check())
                                                            <span class="_19gi7yt0 _19gi7yte _1fragem1j">
                                                                Already have an account?
                                                                <a href="{{ route('customer.login') }}" class="s2kwpi1 _1fragemaf _1fragemat _1fragemb2 s2kwpi2 _1fragemam"> Log in</a>
                                                            </span>
                                                            @endif
                                                    </div>
                                                    <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1o _1fragem25">
                                                        <div class="_7ozb2u2 _1fragem1r _1fragem28 _1fragemaf _1fragem1b _10vrn9p1 _10vrn9p0 _10vrn9p6">
                                                            <div class="_1fragemaf">
                                                                <label id="email-label" for="email" class="cektnc3 _1fragemad _1fragemac _1fragem9v _1fragemb4 _1fragemat _1fragemap _1fragemb2 cektnc6 _1fragema7">
                                                                    <span class="cektnc9">
                                                                        <span class="rermvf1 _1fragem7q _1fragem7s _1fragem15">Email</span>
                                                                    </span>
                                                                </label>
                                                                <div class="_7ozb2u4 _1fragemaf _1fragem1b _1fragem14 _1fragemat _1fragemap _1fragemb2 _1fragemb3 _7ozb2uc _7ozb2un _7ozb2up _7ozb2uj">
                                                                    <input id="email" name="email" type="text"
                                                                        aria-labelledby="email-label"
                                                                        autocomplete="shipping email"
                                                                        autofocus="true"
                                                                        class="_7ozb2uu _1fragemaf _1fragemb4 _1fragem34 _1fragemab _7ozb2uv _7ozb2uz _1fragemat _1fragemap _1fragemb2 _7ozb2u15 _7ozb2u1n"
                                                                        value="{{ old('email',  $shippingEmail) }}"
                                                                        wire:model="shippingEmail">
                                                                        <input type="hidden" name="current_url" value="{{ url()->current() }}" wire:model="currentUrl">
                                                                </div>
                                                                @error('shippingEmail') <span style="color: red;">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1z _1fragem2g">
                                                <section aria-label="Shipping address" class="_1fragem15 _1fragemaf">
                                                    <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1o _1fragem25">
                                                        <h2 class="n8k95w1 _1fragemaf n8k95w3">
                                                            Shipping address</h2>
                                                        <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1o _1fragem25">
                                                            <div id="shippingAddressForm">
                                                                <div aria-hidden="false" class="pxSEU">
                                                                    <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1o _1fragem25">
                                                                        <div class="_1fragemaf _1fragem1b _1mrl40q3 _1fragem1o _1fragem25 _16s97g73 _16s97g75 _16s97g7b _16s97g7d" style="--_16s97g72: minmax(0, 1fr); --_16s97g74: minmax(0, 1fr); --_16s97g7a: minmax(0, 1fr); --_16s97g7c: minmax(0, 1fr);">
                                                                            <div class="vTXBW _10vrn9p1 _10vrn9p0 _10vrn9p6">
                                                                                <div>
                                                                                    <div class="j2JE7">
                                                                                        <label for="Select4" class="QOQ2V NKh24">
                                                                                            <span class="KBYKh">
                                                                                                <span class="rermvf1 _1fragem7q _1fragem7s _1fragem15">Country/Region</span>
                                                                                            </span>
                                                                                        </label>
                                                                                        <select name="countryName"
                                                                                            id="Select4"
                                                                                            required=""
                                                                                            autocomplete="shipping country"
                                                                                            class="_b6uH RR8sg vYo81 RGaKd">
                                                                                            <option
                                                                                                value="ID">
                                                                                                Indonesia
                                                                                            </option>
                                                                                        </select>
                                                                                        <div class="TUEJq">
                                                                                            <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wug a8x1wum"><svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    viewBox="0 0 14 14"
                                                                                                    focusable="false"
                                                                                                    aria-hidden="true"
                                                                                                    class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                                                                                    <path
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"
                                                                                                        d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6">
                                                                                                    </path>
                                                                                                </svg>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="_1fragemaf _1fragem1b _1mrl40q3 _1fragem1o _1fragem25 _16s97g73 _16s97g75 _16s97g7b _16s97g7d" style="--_16s97g72: minmax(0, 1fr); --_16s97g74: minmax(0, 1fr); --_16s97g7a: minmax(0, 1fr); --_16s97g7c: minmax(0, 1fr);">
                                                                            <div class="_7ozb2u2 _1fragem1r _1fragem28 _1fragemaf _1fragem1b _10vrn9p1 _10vrn9p0 _10vrn9p6">
                                                                                <div class="_1fragemaf">
                                                                                    <label id="TextField26-label" for="TextField26" class="cektnc3 _1fragemad _1fragemac _1fragem9v _1fragemb4 _1fragemat _1fragemap _1fragemb2 cektnc6 _1fragema7">
                                                                                        <span class="cektnc9">
                                                                                            <span class="rermvf1 _1fragem7q _1fragem7s _1fragem15">Nama Depan</span>
                                                                                        </span>
                                                                                    </label>
                                                                                    <div class="_7ozb2u4 _1fragemaf _1fragem1b _1fragem14 _1fragemat _1fragemap _1fragemb2 _1fragemb3 _7ozb2uc _7ozb2un _7ozb2up _7ozb2uj">
                                                                                        <input
                                                                                            id="TextField26"
                                                                                            name="first_name"
                                                                                            type="text"
                                                                                            aria-required="false"
                                                                                            aria-labelledby="TextField26-label"
                                                                                            autocomplete="shipping given-name"
                                                                                            class="_7ozb2uu _1fragemaf _1fragemb4 _1fragem34 _1fragemab _7ozb2uv _7ozb2uz _1fragemat _1fragemap _1fragemb2 _7ozb2u15 _7ozb2u1n" wire:model="shippingFirstName">

                                                                                    </div>
                                                                                    @error('shippingFirstName') <span style="color: red;">{{ $message }}</span> @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="_7ozb2u2 _1fragem1r _1fragem28 _1fragemaf _1fragem1b _10vrn9p1 _10vrn9p0 _10vrn9p6">
                                                                                <div class="_1fragemaf">
                                                                                    <label id="TextField27-label"
                                                                                        for="TextField27"
                                                                                        class="cektnc3 _1fragemad _1fragemac _1fragem9v _1fragemb4 _1fragemat _1fragemap _1fragemb2 cektnc6 _1fragema7">
                                                                                        <span class="cektnc9">
                                                                                            <span class="rermvf1 _1fragem7q _1fragem7s _1fragem15">Nama Belakang</span>
                                                                                        </span>
                                                                                    </label>
                                                                                    <div class="_7ozb2u4 _1fragemaf _1fragem1b _1fragem14 _1fragemat _1fragemap _1fragemb2 _1fragemb3 _7ozb2uc _7ozb2un _7ozb2up _7ozb2uj">
                                                                                        <input id="TextField27"
                                                                                            name="last_name"
                                                                                            required=""
                                                                                            type="text"
                                                                                            aria-required="true"
                                                                                            aria-labelledby="TextField27-label"
                                                                                            autocomplete="shipping family-name"
                                                                                            class="_7ozb2uu _1fragemaf _1fragemb4 _1fragem34 _1fragemab _7ozb2uv _7ozb2uz _1fragemat _1fragemap _1fragemb2 _7ozb2u15 _7ozb2u1n" wire:model="shippingLastName">
                                                                                    </div>
                                                                                    @error('shippingLastName') <span style="color: red;">{{ $message }}</span> @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="_1fragemaf _1fragem1b _1mrl40q3 _1fragem1o _1fragem25 _16s97g73 _16s97g75 _16s97g7b _16s97g7d" style="--_16s97g72: minmax(0, 1fr); --_16s97g74: minmax(0, 1fr); --_16s97g7a: minmax(0, 1fr); --_16s97g7c: minmax(0, 1fr);">
                                                                            <div class="Vob8N">
                                                                                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a">
                                                                                    <div class="_7ozb2u2 _1fragem1r _1fragem28 _1fragemaf _1fragem1b _10vrn9p1 _10vrn9p0 _10vrn9p6">
                                                                                        <div class="_1fragemaf">
                                                                                            <label id="TextField28-label" for="TextField28" class="cektnc3 _1fragemad _1fragemac _1fragem9v _1fragemb4 _1fragemat _1fragemap _1fragemb2 cektnc6 _1fragema7">
                                                                                                <span class="cektnc9">
                                                                                                    <span class="rermvf1 _1fragem7q _1fragem7s _1fragem15">Alamat</span>
                                                                                                </span>
                                                                                            </label>
                                                                                            <div class="_7ozb2u4 _1fragemaf _1fragem1b _1fragem14 _1fragemat _1fragemap _1fragemb2 _1fragemb3 _7ozb2uc _7ozb2un _7ozb2up _7ozb2uj">
                                                                                                <input id="TextField28" name="alamat" required="" type="text" aria-required="true" aria-labelledby="TextField28-label" autocomplete="shipping address-line1" class="_7ozb2uu _1fragemaf _1fragemb4 _1fragem34 _1fragemab _7ozb2uv _7ozb2uz _1fragemat _1fragemap _1fragemb2 _7ozb2u15 _7ozb2u1n"
                                                                                                wire:model="shippingAddress">
                                                                                            </div>
                                                                                            @error('shippingAddress') <span style="color: red;">{{ $message }}</span> @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="_1fragemaf _1fragem1b _1mrl40q3 _1fragem1o _1fragem25 _16s97g73 _16s97g75 _16s97g7b _16s97g7d" style="--_16s97g72: minmax(0, 1fr); --_16s97g74: minmax(0, 1fr); --_16s97g7a: minmax(0, 1fr); --_16s97g7c: minmax(0, 1fr);">
                                                                            <div class="vTXBW _10vrn9p1 _10vrn9p0 _10vrn9p6">
                                                                                <div>
                                                                                    <div class="j2JE7">
                                                                                        <label for="Select5" class="QOQ2V NKh24">
                                                                                            <span class="KBYKh">
                                                                                                <span class="rermvf1 _1fragem7q _1fragem7s _1fragem15">Provinsi</span>
                                                                                            </span>
                                                                                        </label>
                                                                                        <select name="province" id="Select5" required="" autocomplete="shipping address-level1" class="_b6uH RR8sg vYo81 RGaKd"  wire:change="updateDistrict($event.target.value)">
                                                                                            @if ($selectedProvince == "")
                                                                                                <option value="" {{$selectedProvince == "" ? 'selected' : '' }}>Pilih Provinsi</option>
                                                                                            @endif
                                                                                            @foreach ($province as $item)
                                                                                                <option value="{{$item}}"
                                                                                                {{ $item == $selectedProvince ? 'selected' : ''}}
                                                                                                >{{$item}}</option>
                                                                                            @endforeach
                                                                                        </select>

                                                                                        <div class="TUEJq">
                                                                                            <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wug a8x1wum"><svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    viewBox="0 0 14 14"
                                                                                                    focusable="false"
                                                                                                    aria-hidden="true"
                                                                                                    class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                                                                                    <path
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"
                                                                                                        d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6">
                                                                                                    </path>
                                                                                                </svg>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    @error('selectedProvince') <span style="color: red;">{{ $message }}</span> @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="vTXBW _10vrn9p1 _10vrn9p0 _10vrn9p6">
                                                                                <div>
                                                                                    <div class="j2JE7">
                                                                                        <label for="Select5" class="QOQ2V NKh24">
                                                                                            <span class="KBYKh">
                                                                                                <span class="rermvf1 _1fragem7q _1fragem7s _1fragem15">Kode Pos</span>
                                                                                            </span>
                                                                                        </label>
                                                                                        <select name="post_code" id="Select5" required="" autocomplete="shipping address-level1" class="_b6uH RR8sg vYo81 RGaKd"  wire:change="updateZipCode($event.target.value)"wire:target="updateArea" wire:loading.attr="disabled">
                                                                                            @if ($shippingZipCode == '')
                                                                                                <option value="" {{ $shippingZipCode != '' ? '' : 'selected'}}>Pilih Kodepos</option>
                                                                                            @endif
                                                                                            {{-- @if($postalCode == [])
                                                                                                <option value="{{ $userRegion->post_code }}">{{ $userRegion->post_code }}</option>
                                                                                            @endif --}}

                                                                                            @foreach ($postalCode as $item)
                                                                                                <option value="{{$item}}" {{ $item == $shippingZipCode ? 'selected' : ''}}>{{$item}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <div wire:loading wire:target="updateArea" class="TUEJq">
                                                                                            <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wug a8x1wum">
                                                                                                <div class="loading-spinner"></div>
                                                                                            </span>
                                                                                        </div>
                                                                                        <div class="TUEJq"  wire:loading.remove wire:target="updateArea">
                                                                                            <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wug a8x1wum"><svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    viewBox="0 0 14 14"
                                                                                                    focusable="false"
                                                                                                    aria-hidden="true"
                                                                                                    class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                                                                                    <path
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"
                                                                                                        d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6">
                                                                                                    </path>
                                                                                                </svg>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    @error('shippingZipCode') <span style="color: red;">{{ $message }}</span> @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="_1fragemaf _1fragem1b _1mrl40q3 _1fragem1o _1fragem25 _16s97g73 _16s97g75 _16s97g7b _16s97g7d" style="--_16s97g72: minmax(0, 1fr); --_16s97g74: minmax(0, 1fr); --_16s97g7a: minmax(0, 1fr); --_16s97g7c: minmax(0, 1fr);">
                                                                            <div class="vTXBW _10vrn9p1 _10vrn9p0 _10vrn9p6">
                                                                                <div>
                                                                                    <div class="j2JE7">
                                                                                        <label for="Select4" class="QOQ2V NKh24">
                                                                                            <span class="KBYKh">
                                                                                                <span class="rermvf1 _1fragem7q _1fragem7s _1fragem15">Kota / Kabupaten</span>
                                                                                            </span>
                                                                                        </label>

                                                                                        <select name="district"
                                                                                            id="Select4"
                                                                                            required=""
                                                                                            autocomplete="shipping country"
                                                                                            class="_b6uH RR8sg vYo81 RGaKd"
                                                                                            wire:change="updateSubdistrict($event.target.value)" wire:target="updateDistrict" wire:loading.attr="disabled">
                                                                                            {{-- <option value="" wire:loading wire:target="updateDistrict">Pilih Kota / Kabupaten</option> --}}
                                                                                            @if ($selectedDistrict == '')
                                                                                                <option value="" {{$selectedDistrict ? '' : 'selected'}}>Pilih Kota / Kabupaten</option>
                                                                                            @endif

                                                                                            {{-- @if($districtList == [])
                                                                                                <option value="{{ $userRegion->district }}">{{ $userRegion->district }}</option>
                                                                                            @endif --}}
                                                                                            @foreach ($districtList as $item)
                                                                                                <option value="{{$item}}" {{ $item == $selectedDistrict ? 'selected' : '' }}>{{$item}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <div wire:loading wire:target="updateDistrict" class="TUEJq">
                                                                                            <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wug a8x1wum">
                                                                                                <div class="loading-spinner"></div>
                                                                                            </span>
                                                                                        </div>
                                                                                        <div class="TUEJq"  wire:loading.remove wire:target="updateDistrict">
                                                                                            <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wug a8x1wum"><svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    viewBox="0 0 14 14"
                                                                                                    focusable="false"
                                                                                                    aria-hidden="true"
                                                                                                    class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                                                                                    <path
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"
                                                                                                        d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6">
                                                                                                    </path>
                                                                                                </svg>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    @error('selectedProvince') <span style="color: red;">{{ $message }}</span> @enderror

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="_1fragemaf _1fragem1b _1mrl40q3 _1fragem1o _1fragem25 _16s97g73 _16s97g75 _16s97g7b _16s97g7d" style="--_16s97g72: minmax(0, 1fr); --_16s97g74: minmax(0, 1fr); --_16s97g7a: minmax(0, 1fr); --_16s97g7c: minmax(0, 1fr);">
                                                                            <div class="vTXBW _10vrn9p1 _10vrn9p0 _10vrn9p6">
                                                                                <div>
                                                                                    <div class="j2JE7">
                                                                                        <label for="Select4" class="QOQ2V NKh24">
                                                                                            <span class="KBYKh">
                                                                                                <span class="rermvf1 _1fragem7q _1fragem7s _1fragem15">Kecamatan</span>
                                                                                            </span>
                                                                                        </label>
                                                                                        <select name="subdistrict"
                                                                                            id="Select4"
                                                                                            required=""
                                                                                            autocomplete="shipping country"
                                                                                            class="_b6uH RR8sg vYo81 RGaKd"
                                                                                            wire:change="updateArea($event.target.value)" wire:target="updateSubdistrict" wire:loading.attr="disabled">
                                                                                            {{-- <option value="" wire:loading wire:target="updateDistrict">Pilih Kota / Kabupaten</option> --}}
                                                                                            @if ($selectedSubdistrict == 0)
                                                                                                <option value="" {{$selectedSubdistrict ? '' : 'selected'}}>Pilih Kecamatan</option>
                                                                                            @endif
                                                                                            {{-- @if($subdistrictList == [])
                                                                                                <option value="{{ $userRegion->subdistrict }}" >{{ $userRegion->subdistrict }}</option>
                                                                                            @endif --}}
                                                                                            @foreach ($subdistrictList as $item)
                                                                                                <option value="{{$item}}" {{$item == $shippingSubDistrict ? 'selected' : ''}}>{{$item}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <div wire:loading wire:target="updateSubdistrict" class="TUEJq">
                                                                                            <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wug a8x1wum">
                                                                                                <div class="loading-spinner"></div>
                                                                                            </span>
                                                                                        </div>
                                                                                        <div class="TUEJq"  wire:loading.remove wire:target="updateSubdistrict">
                                                                                            <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wug a8x1wum"><svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    viewBox="0 0 14 14"
                                                                                                    focusable="false"
                                                                                                    aria-hidden="true"
                                                                                                    class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                                                                                    <path
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"
                                                                                                        d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6">
                                                                                                    </path>
                                                                                                </svg>
                                                                                            </span>
                                                                                        </div>
                                                                                    @error('selectedSubdistrict') <span style="color: red;">{{ $message }}</span> @enderror

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="_1fragemaf _1fragem1b _1mrl40q3 _1fragem1o _1fragem25 _16s97g73 _16s97g75 _16s97g7b _16s97g7d" style="--_16s97g72: minmax(0, 1fr); --_16s97g74: minmax(0, 1fr); --_16s97g7a: minmax(0, 1fr); --_16s97g7c: minmax(0, 1fr);">
                                                                            <div class="vTXBW _10vrn9p1 _10vrn9p0 _10vrn9p6">
                                                                                <div>
                                                                                    <div class="j2JE7">
                                                                                        <label for="Select4" class="QOQ2V NKh24">
                                                                                            <span class="KBYKh">
                                                                                                <span class="rermvf1 _1fragem7q _1fragem7s _1fragem15">Kelurahan</span>
                                                                                            </span>
                                                                                        </label>

                                                                                        <select name="area"
                                                                                            id="Select4"
                                                                                            required=""
                                                                                            autocomplete="shipping country"
                                                                                            class="_b6uH RR8sg vYo81 RGaKd" wire:change="areaUpdate($event.target.value)" wire:target="updateArea" wire:loading.attr="disabled">
                                                                                            @if (!$selectedArea)
                                                                                                <option value="" {{$selectedArea ? '' : 'selected'}}>Pilih Kelurahan</option>
                                                                                            @endif
                                                                                            {{-- @if($areaList == [])
                                                                                                <option value="{{ $userRegion->region_id }}">{{ $userRegion->area }}</option>
                                                                                            @endif --}}
                                                                                            @foreach ($areaList as $index=>$item)
                                                                                                <option value="{{$index}}" {{ $index == $selectedArea ? 'selected' : '' }}>{{$item}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <div wire:loading wire:target="updateArea" class="TUEJq">
                                                                                            <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wug a8x1wum">
                                                                                                <div class="loading-spinner"></div>
                                                                                            </span>
                                                                                        </div>
                                                                                        <div class="TUEJq"  wire:loading.remove wire:target="updateArea">
                                                                                            <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wug a8x1wum"><svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    viewBox="0 0 14 14"
                                                                                                    focusable="false"
                                                                                                    aria-hidden="true"
                                                                                                    class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                                                                                    <path
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"
                                                                                                        d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6">
                                                                                                    </path>
                                                                                                </svg>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    @error('selectedArea') <span style="color: red;">{{ $message }}</span> @enderror

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="_1fragemaf _1fragem1b _1mrl40q3 _1fragem1o _1fragem25 _16s97g73 _16s97g75 _16s97g7b _16s97g7d" style="--_16s97g72: minmax(0, 1fr); --_16s97g74: minmax(0, 1fr); --_16s97g7a: minmax(0, 1fr); --_16s97g7c: minmax(0, 1fr);">
                                                                            <div class="_7ozb2u2 _1fragem1r _1fragem28 _1fragemaf _1fragem1b _10vrn9p1 _10vrn9p0 _10vrn9p6">
                                                                                <div class="_1fragemaf">
                                                                                    <label id="TextField32-label" for="TextField32" class="cektnc3 _1fragemad _1fragemac _1fragem9v _1fragemb4 _1fragemat _1fragemap _1fragemb2 cektnc6 _1fragema7">
                                                                                        <span class="cektnc9">
                                                                                            <span class="rermvf1 _1fragem7q _1fragem7s _1fragem15">Phone number</span>
                                                                                        </span>
                                                                                    </label>
                                                                                    <div class="_7ozb2u4 _1fragemaf _1fragem1b _1fragem14 _1fragemat _1fragemap _1fragemb2 _1fragemb3 _7ozb2uc _7ozb2un _7ozb2up _7ozb2uj">
                                                                                        <input id="TextField32" name="phonenumber" required="" type="tel" aria-required="true" aria-labelledby="TextField32-label" autocomplete="shipping tel" class="_7ozb2uu _1fragemaf _1fragemb4 _1fragem34 _1fragemab _7ozb2uv _7ozb2uz _1fragemat _1fragemap _1fragemb2 _1fragem4a _1fragem4k _7ozb2u14 _7ozb2u1n" wire:model="shippingPhoneNumber">
                                                                                        <div class="_1fragemaf _1fragemb4 _1fragem9 _1fragem11 _7ozb2u1k">
                                                                                            <div class="_1fragem17 _1fragemaf _1fragem38">
                                                                                                <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1o _1fragem25 _1fragem0 _1fragem4 _1fragem38">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    @error('shippingPhoneNumber') <span style="color: red;">{{ $message }}</span> @enderror

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{-- <div class="_1fragem15 _1fragemah _1fragemaf">
                                                                        <input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_firstName" name="firstName" autocomplete="shipping given-name">
                                                                        <input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_lastName" name="lastName" autocomplete="shipping family-name">
                                                                        <input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_address1" name="address1" autocomplete="shipping address-line1">
                                                                        <input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_address2" name="address2" autocomplete="shipping address-line2">
                                                                        <input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_city" name="city" autocomplete="shipping address-level2">
                                                                        <input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_country" name="country" autocomplete="shipping country">
                                                                        <input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_zone" name="zone" autocomplete="shipping address-level1">
                                                                        <input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_address_level1" name="address-level1" autocomplete="shipping address-level1">
                                                                        <input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_province" name="province" autocomplete="shipping address-level1">
                                                                        <input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_postalCode" name="postalCode" autocomplete="shipping postal-code">
                                                                        <input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_phone" name="phone" autocomplete="shipping tel">
                                                                    </div> --}}
                                                                </div>
                                                            </div>
                                                            {{-- <div>
                                                                <div class="_1fragemaf _1fragem17">
                                                                    <div class="_1mmswk95 _1fragemaf">
                                                                        <input type="checkbox"
                                                                            id="save_shipping_information"
                                                                            name="save_shipping_information"
                                                                            class="_1mmswk97 _1fragem40 _1fragem3w _1fragem44 _1fragem3s _1fragem4w _1fragem4t _1fragem4z _1fragem4q _1fragem5b _1fragem56 _1fragem5g _1fragem51 _1fragem13 _1fragem15 _1fragem34 _1fragem10 _1fragemat _1fragemao _1fragemaz _1mmswk9a _1mmswk9c">
                                                                        <div class="_1mmswk9o _1fragemac _1fragem9v _1fragemad _1fragemao _1fragemb2 _1fragemat">
                                                                            <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wug a8x1wum"><svg
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 14 14"
                                                                                    focusable="false"
                                                                                    aria-hidden="true"
                                                                                    class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                                                                    <path
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        d="m12.1 2.8-5.877 8.843a.35.35 0 0 1-.54.054L1.4 7.4">
                                                                                    </path>
                                                                                </svg>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <label for="save_shipping_information"class="_1mmswk9k _1fragem15 _1fragem9q _1fragem13 _1fragem9e">
                                                                        Save
                                                                    </label>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="oQEAZ WD4IV">
                                            <div>
                                                <a class="QT4by rqC98 hodFu VDIfJ j6D1f janiy" style="color: white;" wire:click="informationStepSubmit"
                                                wire:loading.attr="disabled" wire:target="informationStepSubmit">
                                                    <!-- Tautan hanya akan menampilkan teks "Loading..." ketika tindakan sedang berlangsung -->
                                                    <span wire:loading>Loading...</span>
                                                    <span wire:loading.remove>Continue to shipping</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="{{ route('customer.cart') }}" class="QT4by eVFmT j6D1f janiy adBMs">
                                                    <span class="AjwsM">
                                                        <div class="_1fragem17 _1fragemaf _1fragem38">
                                                            <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1t _1fragem2a _1fragem0 _1fragem4 _1fragem38">
                                                                <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wuh a8x1wuf a8x1wum"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 14 14"
                                                                        focusable="false"
                                                                        aria-hidden="true"
                                                                        class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                                                        <path
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M8.4 11.9 3.748 7.248a.35.35 0 0 1 0-.495L8.4 2.1">
                                                                        </path>
                                                                    </svg>
                                                                </span>
                                                                <span class="_19gi7yt0 _19gi7yte _1fragem1j">Return to cart</span>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="_1fragem15 _1fragemah _1fragemaf">
                                <button type="submit"
                                        tabindex="-1"
                                        aria-hidden="true"
                                        wire:click="informationStepSubmit"
                                        wire:loading.attr="disabled"
                                        style="color: white;"
                                        {{-- <!-- Disable button saat sedang memuat --> --}}
                                        wire:target="informationStepSubmit">
                                        <!-- Menunjukkan efek loading saat tindakan 'informationStepSubmit' sedang berlangsung -->
                                        <!-- Tombol hanya akan menampilkan teks "Loading..." ketika tindakan sedang berlangsung -->
                                    <span wire:loading.remove>Continue to shipping</span>
                                    <span wire:loading>Loading...</span>
                                </button>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>
</div>
