<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Edit Tag</h1>
    </x-slot>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <form action="{{ route('administrator.master-data.tag.update', $tag->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('tag::_partials._form', ['tag' => $tag, 'edit' => true])

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Update Tag
                    </button>
                </div>
            </form>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</x-base-layout>
