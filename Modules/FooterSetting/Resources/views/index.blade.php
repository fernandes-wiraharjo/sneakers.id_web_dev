<x-base-layout>
    <x-slot name="styles">
        <style>
            .separator.separator-content {
                margin-left: 1em;
                margin-right: 1em;
            }

        </style>
    </x-slot>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Footer Setting</h1>
    </x-slot>

    @if ($errors->any())
    <!--begin::Alert-->
    <div class="alert alert-dismissible bg-danger border border-danger d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10">
        <!--begin::Close-->
        <button type="button" class="position-absolute top-0 end-0 m-2 btn btn-icon btn-icon-light" data-bs-dismiss="alert">
            <span class="svg-icon svg-icon-1"><i class="fas fa-times fs-2x"></i></span>
        </button>
        <!--end::Close-->

        <!--begin::Icon-->
        <span class="svg-icon svg-icon-5tx svg-icon-danger mb-5"><i class="fas fa-exclamation-circle fs-5x"></i></span>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="text-center text-light">
            <!--begin::Separator-->
            <div class="separator separator-dashed border-danger opacity-25 mb-5"></div>
            <!--end::Separator-->

            <!--begin::Content-->
            <div class="mb-9 text-light">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Alert-->
    @endif

   <!--begin::Card-->
   <div class="card card-flush shadow-sm">
    <form action="{{ route('administrator.master-data.footer-setting.store') }}" method="post"
    id="form" enctype="multipart/form-data">
            @csrf
        <div class="card-header">
            <h3 class="card-title">Footer Setting</h3>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-sm btn-primary" id="form-submit">
                    Update
                </button>
            </div>
        </div>
        <div class="card-body">

            @include('footersetting::_partials._form-about', ['about' => $footer->about ?? ''])

            <div class="separator separator-content my-15">Contact Us</div>

            @include('footersetting::_partials._form-contact', ['address' => $footer->address ?? '', 'maps' => $footer->maps ?? ''])

            <div class="separator separator-content my-15">Social Media</div>

            @include('footersetting::_partials._form-social-media',['social_media' => $footer->social_media ?? []])
        </div>
    </form>
    <!--end::Card body-->
</div>
<!--end::Card-->
</x-base-layout>
