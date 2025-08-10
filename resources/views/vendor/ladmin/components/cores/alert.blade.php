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

@foreach ($status as $state)
    @if(session()->has($state))
        <!--begin::Alert-->
        <div class="alert alert-{{ $state }} bg-warning border border-warning d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10">
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
                    @foreach (session()->get($state) as $item)
                        <li>{!! $item !!}</li>
                    @endforeach
                    </ul>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
    @endif
@endforeach
