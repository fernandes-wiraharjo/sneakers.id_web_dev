<x-base-layout>
    <x-slot name="styles">
        <style>
            .service-item {
                background: #f5f8fa;
                padding: 1.5rem;
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
                    <h2 class="fw-bolder text-dark mb-7">Courier Services</h2>
                    
                    <div class="d-flex flex-column gap-7" id="services-container">
                        @foreach($courier->services as $service)
                        <div class="service-item d-flex flex-row gap-5 align-items-center">
                            <input type="hidden" name="services[{{ $loop->index }}][id]" value="{{ $service->id }}">
                            
                            <div class="flex-grow-1">
                                <label class="required fw-bold fs-6 mb-2">Service Code</label>
                                <input type="text" name="services[{{ $loop->index }}][code]" 
                                    class="form-control form-control-solid" 
                                    placeholder="Enter service code (e.g. REG, YES)" 
                                    value="{{ $service->code }}" required />
                            </div>
                            
                            <div class="flex-grow-1">
                                <label class="required fw-bold fs-6 mb-2">Service Name</label>
                                <input type="text" name="services[{{ $loop->index }}][name]" 
                                    class="form-control form-control-solid" 
                                    placeholder="Enter service name" 
                                    value="{{ $service->name }}" required />
                            </div>
                            
                            <div class="form-check form-check-custom form-check-solid mt-5">
                                <input class="form-check-input" type="checkbox" 
                                    name="services[{{ $loop->index }}][is_active]" 
                                    value="1" {{ $service->is_active ? 'checked' : '' }} />
                                <label class="form-check-label">Active</label>
                            </div>
                            
                            <button type="button" class="btn btn-icon btn-light-danger mt-5 remove-service">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="d-flex justify-content-center mt-7">
                        <button type="button" class="btn btn-light-primary" id="add-service">
                            <i class="fas fa-plus me-2"></i>
                            Add New Service
                        </button>
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
    @push('scripts')
    <script>
        // Template for new service item
        const serviceTemplate = `
            <div class="service-item d-flex flex-row gap-5 align-items-center">
                <div class="flex-grow-1">
                    <label class="required fw-bold fs-6 mb-2">Service Code</label>
                    <input type="text" name="services[INDEX][code]" 
                        class="form-control form-control-solid" 
                        placeholder="Enter service code (e.g. REG, YES)" 
                        required />
                </div>
                
                <div class="flex-grow-1">
                    <label class="required fw-bold fs-6 mb-2">Service Name</label>
                    <input type="text" name="services[INDEX][name]" 
                        class="form-control form-control-solid" 
                        placeholder="Enter service name" 
                        required />
                </div>
                
                <div class="form-check form-check-custom form-check-solid mt-5">
                    <input class="form-check-input" type="checkbox" 
                        name="services[INDEX][is_active]" 
                        value="1" checked />
                    <label class="form-check-label">Active</label>
                </div>
                
                <button type="button" class="btn btn-icon btn-light-danger mt-5 remove-service">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        $(document).ready(function() {
            // Add new service
            $('#add-service').on('click', function() {
                const container = $('#services-container');
                const newIndex = container.children().length;
                const newService = serviceTemplate.replace(/INDEX/g, newIndex);
                
                container.append(newService);
            });

            // Remove service
            $('#services-container').on('click', '.remove-service', function() {
                $(this).closest('.service-item').remove();
            });
        });
    </script>
    @endpush
</x-base-layout>
