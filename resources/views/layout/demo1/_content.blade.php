<!--begin::Container-->
<div id="kt_content_container" class="{{ theme()->printHtmlClasses('content-container', false) }}">
    @include('components.errors')
    {{ $slot }}
</div>
<!--end::Container-->
