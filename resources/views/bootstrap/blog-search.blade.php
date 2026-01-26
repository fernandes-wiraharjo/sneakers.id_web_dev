@extends('bootstrap.layout')

@section('title', 'Blog Search')
@section('description', 'Search blog articles')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-12 col-md-8 offset-md-2 py-5">
            <form action="{{ route('blog.search') }}" method="get">
                <div class="input-group rounded-pill border py-1 px-2 w-100">
                    <span class="input-group-text rounded-pill bg-white border-0 pe-0">
                        <span class="iconify fs-4" data-icon="material-symbols:search-rounded"></span>
                    </span>
                    <input type="text"
                           class="form-control border-0"
                           name="q"
                           value="{{ $keyword }}"
                           placeholder="Search keyword..."
                           aria-label="Search">
                    <button type="submit" class="btn btn-dark rounded-pill px-4 shadow">Search</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 d-flex align-items-center mb-5">
            <a href="javascript:history.back()" class="border bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3 p-2">
                <span class="iconify fs-3" data-icon="stash:arrow-left-duotone"></span>
            </a>
            <h1 class="fw-bold mb-0">
                SEARCH: "{{ $keyword }}"
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-8 pe-5">
            @php
                $count_results = $blog_results->count();
            @endphp

            @forelse ($blog_results as $index => $item)
                <a href="{{ route('blog.show', $item->slug) }}" class="text-decoration-none text-reset">
                    <div class="row mb-3">
                        <div class="col-4">
                            <img class="img-fluid rounded-4" src="{{ $item->featured_image_url }}" alt="{{ $item->title }}">
                        </div>
                        <div class="col-8">
                            <h2 class="fs-5 fw-bold">{{ $item->title }}</h2>
                            <p class="text-danger mb-1">{{ $item->created_at->format('d F Y') }}</p>
                            <p class="text-muted mb-0">
                                {{ $item->search_excerpt ?? $item->excerpt }}
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
                    <p class="text-muted">It seems we can’t find any results based on your search.</p>
                </div>
            @endforelse
        </div>

        <div class="col-12 col-md-4">
            @include('bootstrap.parts.blog-sidebar', ['popular' => $popular, 'brands' => $brands])
        </div>
    </div>
</div>
@endsection


