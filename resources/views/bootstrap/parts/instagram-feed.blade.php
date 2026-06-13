@if (! empty($instagram_posts))
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold text-uppercase mb-1">Follow Us on Instagram</h2>
            @if (! empty($instagram_username))
                <a href="https://www.instagram.com/{{ $instagram_username }}/" target="_blank" rel="noopener noreferrer" class="text-decoration-none text-muted">
                    {{ '@' . $instagram_username }}
                </a>
            @endif
        </div>
    </div>

    <div class="row g-3">
        @foreach ($instagram_posts as $post)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ $post['permalink'] }}" target="_blank" rel="noopener noreferrer" class="d-block ratio ratio-1x1 overflow-hidden rounded-3 shadow-sm instagram-feed-item">
                    <img
                        src="{{ $post['image_url'] }}"
                        alt="{{ \Illuminate\Support\Str::limit(strip_tags($post['caption'] ?? ''), 80) }}"
                        class="img-fluid w-100 h-100 object-fit-cover"
                        loading="lazy"
                    >
                </a>
            </div>
        @endforeach
    </div>
</div>

@push('styles')
<style>
    .instagram-feed-item img {
        transition: transform 0.25s ease;
    }

    .instagram-feed-item:hover img {
        transform: scale(1.05);
    }
</style>
@endpush
@endif
