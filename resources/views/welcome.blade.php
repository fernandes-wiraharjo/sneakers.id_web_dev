<x-base-front-layout>
    {{-- <div class="d-flex mh-225px mw-100 h-65px min-h-65px bg-black text-white"> --}}
    @include('public.partials._navbar')
    {{-- </div> --}}

    @livewire('banner-image')

    <div class="m-10 text-center">
        <div class="align-center mb-10">
            <h2>NEW RELEASES</h2>
        </div>

        @livewire('new-release-item')

        <div class="m-5 text-center">
            <div>
                <a class="btn btn-light btn-active-color-dark" href="/collections/new-release">SEE MORE</a>
            </div>
        </div>
    </div>

    <div class="m-10 text-center">
        <div class="align-center mb-10">
            <h2>BEST SELLER</h2>
        </div>

        @livewire('best-sellers')

        <div class="m-5 text-center">
            <div>
                <a class="btn btn-light btn-active-color-dark" href="/collections/best-seller">SEE MORE</a>
            </div>
        </div>
    </div>
</x-base-front-layout>
