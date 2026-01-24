@php
    $count_results = $blog_results->count();
@endphp

@forelse ($blog_results as $index => $item)
    @if (!empty($is_append) && $index === 0)
        <hr class="mt-3">
    @endif

    <a href="{{ route('blog.show', $item->slug) }}" class="text-decoration-none text-reset">
        <div class="row mb-3">
            <div class="col-4">
                <img class="img-fluid rounded-4" src="{{ $item->featured_image_url }}" alt="{{ $item->title }}">
            </div>
            <div class="col-8">
                <h2 class="fs-5 fw-bold">{{ $item->title }}</h2>
                <p class="text-danger mb-1">{{ $item->created_at->format('d F Y') }}</p>
                <p class="text-muted mb-0">
                    {{ $item->excerpt }}
                </p>
            </div>
        </div>
    </a>
    @if ($index < $count_results - 1)
        <hr class="mt-3">
    @endif
@empty
    <div class="text-center py-5">
        <img src="{{ asset('stores-info/product-not-found.webp') }}" alt="Not Found" class="img-fluid">
        <h4 class="fw-bold">No Result Found</h4>
        <p class="text-muted">It seems we can’t find any articles yet.</p>
    </div>
@endforelse


