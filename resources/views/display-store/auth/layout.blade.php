@extends('display-store.store-theme._base')

@section('title', 'SNEAKERS.ID')

@section('body')
<div style="width: 80%;padding: 6% 0 6%; margin:auto;">
    {{ $slot }}
</div>
{{-- <div class="d-flex flex-column flex-root">
        <!--begin::Authentication-->
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url({{ asset(theme()->getIllustrationUrl('21.png')) }})">

            <div class="d-flex flex-left flex-column flex-column-auto p-10 pb-lg-5">
                <a href="/" class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Back to Sneakers Store"><i class="fas fa-arrow-left fs-4 me-2"></i></a>
            </div>
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="/" class="mb-12">
                    @if (config('ladmin.logo'))
                        <img src="{{ config('ladmin.logo') }}" alt="Logo" class="h-45px">
                    @else
                        {{ config('app.name') }}
                    @endif
                </a>
                <!--end::Logo-->

                <!--begin::Wrapper-->
                <div class="{{ $wrapperClass ?? '' }} bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    {{ $slot }}
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->

            <!--begin::Footer-->
            <div class="d-flex flex-center flex-column-auto p-10">
                <!--begin::Links-->
                <div class="d-flex align-items-center fw-bold fs-6">
                    {{-- <a href="{{ $theme->getOption("general", "about") }}" class="text-muted text-hover-primary px-2">{{ __('About') }}</a>

                    <a href="{{ $theme->getOption('general', 'contact') }}" class="text-muted text-hover-primary px-2">{{ __('Contact Us') }}</a>

                    <a href="{{ $theme->getOption('product', 'purchase') }}" class="text-muted text-hover-primary px-2">{{ __('Purchase') }}</a> --}}
                {{-- </div> --}}
                <!--end::Links-->
            {{-- </div> --}}
            <!--end::Footer-->
        {{-- </div> --}}
        <!--end::Authentication-->
    {{-- </div> --}}
@endsection
