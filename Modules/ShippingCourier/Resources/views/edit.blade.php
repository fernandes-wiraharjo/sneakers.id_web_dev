<x-base-layout>
    <x-slot name="styles">
        <style>
            .service-item {
                background: #f5f8fa;
                padding: 1rem 1.5rem;
                border-radius: 0.475rem;
            }
        </style>
    </x-slot>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Edit Shipping Courier</h1>
    </x-slot>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <form action="{{ route('administrator.master-data.shipping-courier.update', $courier->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="required fw-bold fs-6 mb-2">Code</label>
                    <input type="text" name="code" class="form-control form-control-solid mb-3 mb-lg-0 @error('code') is-invalid @enderror"
                        placeholder="Enter courier code" value="{{ old('code', $courier->code) }}" required />
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="required fw-bold fs-6 mb-2">Name</label>
                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0 @error('name') is-invalid @enderror"
                        placeholder="Enter courier name" value="{{ old('name', $courier->name) }}" required />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $courier->is_active ? 'checked' : '' }} />
                        <span class="form-check-label fw-bold">Active</span>
                    </label>
                </div>
                <!--end::Input group-->

                <!--begin::Services Section-->
                <div class="separator my-10"></div>

                <div class="mb-7">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-7">
                        <div>
                            <h2 class="fw-bolder text-dark mb-1">Courier Services</h2>
                            <p class="text-muted mb-0">Services are loaded from RajaOngkir using two queries: intracity (same origin/destination) and intercity (origin to sample destination).</p>
                        </div>
                        <a href="{{ route('administrator.master-data.shipping-courier.edit', $courier->id) }}" class="btn btn-light-primary btn-sm">
                            <i class="fas fa-sync-alt me-2"></i>
                            Refresh from RajaOngkir
                        </a>
                    </div>

                    @if($apiError)
                        <div class="alert alert-warning">
                            {{ $apiError }}
                        </div>
                    @endif

                    <div class="d-flex flex-column gap-4" id="services-container">
                        @php
                            $displayServices = old('services', $services);
                        @endphp
                        @forelse($displayServices as $index => $service)
                            <div class="service-item d-flex flex-row gap-5 align-items-center">
                                @if(!empty($service['id']))
                                    <input type="hidden" name="services[{{ $index }}][id]" value="{{ $service['id'] }}">
                                @endif
                                <input type="hidden" name="services[{{ $index }}][code]" value="{{ $service['code'] }}">
                                <input type="hidden" name="services[{{ $index }}][name]" value="{{ $service['name'] }}">

                                <div class="flex-grow-1">
                                    <div class="fw-bold text-dark">{{ $service['code'] }}</div>
                                    <div class="text-muted">{{ $service['name'] }}</div>
                                </div>

                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox"
                                        name="services[{{ $index }}][is_active]"
                                        value="1" {{ !empty($service['is_active']) ? 'checked' : '' }} />
                                    <label class="form-check-label">Active</label>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-light border">
                                No services available for this courier.
                            </div>
                        @endforelse
                    </div>
                </div>
                <!--end::Services Section-->

                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <a href="{{ route('administrator.master-data.shipping-courier.index') }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Courier</button>
                </div>
                <!--end::Actions-->
            </form>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</x-base-layout>
