@foreach ($popular as $item)
    <div class="row align-items-center mb-3">
        <div class="col-7">
            @if($item->category)
                <a href="{{ url('blog/category/' . $item->category->id) }}" class="category-pills d-inline-block">
                    {{ $item->category->name }}
                </a>
            @endif
            <a href="{{ route('blog.show', $item->slug) }}">
                <h2 class="fs-5 fw-bold my-1">{{ $item->title }}</h2>
            </a>
            <p class="text-danger mb-0">{{ date('d F Y', strtotime($item->created_at)) }}</p>
        </div>
        <div class="col-5">
            <a href="{{ route('blog.show', $item->slug) }}">
                <img class="img-fluid rounded-4" src="{{ $item->featured_image_url }}" alt="{{ $item->title }}">
            </a>
        </div>
    </div>
@endforeach


