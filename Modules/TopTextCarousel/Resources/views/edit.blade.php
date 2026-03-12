<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Edit Top Text Carousel</h1>
    </x-slot>
    <div class="card">
        <div class="card-body pt-6">
            <form action="{{ route('administrator.master-data.top-text-carousel.update', $topTextCarousel->id) }}" method="post" id="top-text-carousel-form">
                @csrf
                @method('PUT')
                @include('toptextcarousel::_partials._form', ['topTextCarousel' => $topTextCarousel, 'edit' => true])
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>
