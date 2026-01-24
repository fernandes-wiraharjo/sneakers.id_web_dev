@extends('bootstrap.layout')

@section('title', $blog->title)
@section('description', \Illuminate\Support\Str::limit($blog->plain_text, 160))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8 mb-5 pe-md-5">
            <h1 class="fw-bold text-uppercase">{{ $blog->title }}</h1>
            <div class="d-flex align-items-center justify-content-start gap-3">
                <div>
                    <span class="iconify fs-4 text-danger" data-icon="mdi:user"></span>
                    <span class="text-muted">{{ $blog->author }}</span>
                </div>
                <div>
                    <span class="iconify fs-4 text-danger" data-icon="fluent:calendar-ltr-16-filled"></span>
                    <span class="text-muted">{{ $blog->created_at->format('d F Y') }}</span>
                </div>
                <div>
                    <span class="iconify fs-4 text-danger" data-icon="majesticons:clock"></span>
                    <span class="text-muted">{{ $blog->created_at->format('h:i A') }}</span>
                </div>
            </div>

            <img src="{{ $blog->featured_image_url }}" alt="{{ $blog->title }}" class="img-fluid my-4 rounded-4 shadow">

            <div class="elfsight-app-01c815c6-c009-4fb2-ba66-4fc27e3a7e17" data-elfsight-app-lazy></div>

            <div class="blog-content my-3">
                {!! $blog->content !!}
            </div>
            
            <div class="elfsight-app-01c815c6-c009-4fb2-ba66-4fc27e3a7e17" data-elfsight-app-lazy></div>
        </div>

        <div class="col-12 col-md-4">
            @include('bootstrap.parts.blog-sidebar', ['popular' => $popular, 'brands' => $brands])
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Elfsight Social Share Buttons | Sneakers.id Social Share Buttons -->
<script src="https://elfsightcdn.com/platform.js" async></script>
@endpush