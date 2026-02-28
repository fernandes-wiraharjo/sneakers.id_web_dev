<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Create Top Text Carousel</h1>
    </x-slot>
    <div class="card">
        <div class="card-body pt-6">
            <form action="{{ route('administrator.master-data.top-text-carousel.store') }}" method="post" id="top-text-carousel-form">
                @csrf
                @include('toptextcarousel::_partials._form', ['topTextCarousel' => $topTextCarousel, 'edit' => false])
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>
