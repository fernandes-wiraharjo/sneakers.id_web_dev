<x-base-layout>
    <x-slot name="styles">
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
