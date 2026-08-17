@extends('bootstrap.layout')

@section('title', 'Customer Reviews')
@section('description', 'All customer reviews for SNEAKERS.ID products')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 d-flex align-items-center">
            <a href="{{ route('store') }}" class="border bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3 p-2">
                <span class="iconify fs-3" data-icon="stash:arrow-left-duotone"></span>
            </a>
            <h1 class="fw-bold mb-0 text-uppercase">Customer Reviews</h1>
        </div>
    </div>

    <div class="card rounded-4 border-1 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row g-4 align-items-center">
                <div class="col-12 col-md-auto text-center text-md-start">
                    <p class="text-muted text-uppercase fw-bold mb-1 small">Overall Rating</p>
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                        <span class="display-4 fw-bold mb-0">{{ number_format($summary['average'], 1) }}</span>
                        <div>
                            @php $avgRating = $summary['average']; @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($avgRating >= $i)
                                    <span class="iconify text-warning fs-4" data-icon="material-symbols:star"></span>
                                @elseif($avgRating >= $i - 0.5)
                                    <span class="iconify text-warning fs-4" data-icon="material-symbols:star-half"></span>
                                @else
                                    <span class="iconify text-secondary fs-4" data-icon="material-symbols:star"></span>
                                @endif
                            @endfor
                            <p class="text-secondary mb-0 mt-1">{{ number_format($summary['total']) }} reviews</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md">
                    <p class="text-muted text-uppercase fw-bold mb-2 small">Filter by rating</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('reviews.all') }}"
                           class="btn {{ $ratingFilter === null ? 'btn-dark' : 'btn-outline-dark' }}">
                            All <span class="text-secondary">({{ $summary['total'] }})</span>
                        </a>
                        @for($i = 5; $i >= 1; $i--)
                            <a href="{{ route('reviews.all', ['rating' => $i]) }}"
                               class="btn {{ $ratingFilter === $i ? 'btn-dark' : 'btn-outline-dark' }} d-flex align-items-center gap-1">
                                {{ $i }}
                                <span class="iconify text-warning" data-icon="material-symbols:star"></span>
                                <span class="text-secondary">({{ $summary['distribution'][$i] ?? 0 }})</span>
                            </a>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($reviews->isEmpty())
        <div class="text-center py-5">
            <p class="text-muted mb-0">No reviews found for this filter.</p>
        </div>
    @else
        <div class="d-flex flex-column gap-3">
            @foreach($reviews as $review)
                @include('bootstrap.parts.review-all-item', ['review' => $review])
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $reviews->appends(request()->except('page'))->onEachSide(2)->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection
