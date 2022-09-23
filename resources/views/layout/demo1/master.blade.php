@extends('base.base')

@section('content')

    <!--begin::Main-->
    @if (theme()->getOption('layout', 'main/type') === 'blank')
        <div class="d-flex flex-column flex-root">
            {{ $slot }}
        </div>
    @else
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="page d-flex flex-row flex-column-fluid">
            @if( theme()->getOption('layout', 'aside/display') === true )
                {{ theme()->getView('layout/aside/_base') }}
            @endif

                <!--begin::Wrapper-->
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                {{ theme()->getView('layout/header/_base') }}

                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid {{ theme()->printHtmlClasses('content', false) }}" id="kt_content">
                        <div class="toolbar" id="kt_toolbar">
                            <div id="kt_toolbar_container" class="{{ theme()->printHtmlClasses('toolbar-container', false) }} d-flex flex-stack">
                                <div class="d-flex align-items-center me-3">
                                    {{ $title ?? 'Page Title'}}
                                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                                    <x-ladmin-breadcrumb />
                                </div>
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center py-1">
                                    {{ $button_create ?? null }}
                                </div>
                            </div>
                        </div>

                        <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Post-->
                            {{ theme()->getView('layout/_content', compact('slot')) }}
                        <!--end::Post-->
                        </div>
                    </div>
                    <!--end::Content-->

                    {{ theme()->getView('layout/_footer') }}
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Root-->

        <!--begin::Drawers-->
        {{ theme()->getView('partials/topbar/_activity-drawer') }}
        {{ theme()->getView('partials/explore/_main') }}
        <!--end::Drawers-->

        @if(theme()->getOption('layout', 'scrolltop/display') === true)
            {{ theme()->getView('layout/_scrolltop') }}
        @endif
    @endif
    <!--end::Main-->

@endsection
