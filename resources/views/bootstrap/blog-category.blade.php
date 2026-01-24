@extends('bootstrap.layout')

@section('title', $category->name)
@section('description', 'Blog category: ' . $category->name)

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center py-5">
            <a href="javascript:history.back()" class="border bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3 p-2">
                <span class="iconify fs-3" data-icon="stash:arrow-left-duotone"></span>
            </a>
            <h1 class="fw-bold mb-0 text-uppercase">
                {{ $category->name }}
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
                    <p class="text-muted">It seems we can’t find any articles in this category yet.</p>
                </div>
            @endforelse
        </div>

        <div class="col-12 col-md-4">
            @include('bootstrap.parts.blog-sidebar', ['popular' => $popular, 'brands' => $brands])
        </div>
    </div>
</div>
@endsection


