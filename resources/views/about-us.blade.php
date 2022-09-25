@extends('store-theme._base')

@section('title', 'ABOUT US')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/about-us.css') }}" />
@endpush

@section('body')

@endsection

@push('scripts')
    <script src="{{ asset('js/pages/about-us.js') }}" defer></script>
@endpush
