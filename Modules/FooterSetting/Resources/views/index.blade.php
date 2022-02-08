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

   <!--begin::Card-->
   <div class="card card-flush shadow-sm">
    <form action="{{ route('administrator.master-data.footer-setting.store') }}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="card-header">
            <h3 class="card-title">Footer Setting</h3>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-sm btn-primary">
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
