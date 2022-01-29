<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Create Role</h1>
    </x-slot>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <form action="{{ route('administrator.access.role.store') }}" method="post">
                @csrf

                @include('vendor.ladmin.role._partials._form', ['role' => (new App\Models\Role)])

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Submit Role
                    </button>
                </div>
            </form>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</x-base-layout>
