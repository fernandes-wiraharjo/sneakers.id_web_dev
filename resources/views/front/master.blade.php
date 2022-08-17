@extends('base.base-front')

@push('styles')
<style>
    .menu-parent {
        background-color: unset;
    }

    .menu-state-bg .menu-item .menu-link:hover:not(.disabled):not(.active) {
        background-color: unset;
    }
    .menu-state-bg .menu-item .menu-link:active {
        background-color: unset;
    }

    .menu-state-bg .menu-item.here > .menu-link, .menu-state-bg .menu-item.show > .menu-link {
        background-color: unset;
    }

    .menu-title {
        color: black;
    }

    @media (min-width: 992px) {
        .menu-sub-lg-dropdown {
            border-radius: unset;
        }
    }
</style>
@endpush

@section('content')

    <div class="d-flex flex-column flex-root">
        {{ $slot }}

        @include('partials.layout.footer', ['footer' => $footer])
    </div>
@endsection
