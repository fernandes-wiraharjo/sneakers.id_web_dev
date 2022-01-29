<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Edit Banner</h1>
    </x-slot>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <form action="{{ route('administrator.master-data.banner.update', $banner->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('banner::_partials._form', ['banner' => $banner])

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Update Banner
                    </button>
                </div>
            </form>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</x-base-layout>
