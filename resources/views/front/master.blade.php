@extends('base.base-front')

@section('content')
    @include('public.partials._navbar', ['brand_menu' => $brand_menu])

    <div class="d-flex flex-column flex-root py-5">
        {{ $slot }}
    </div>

    @include('partials.layout.footer', ['footer' => $footer])
@endsection
