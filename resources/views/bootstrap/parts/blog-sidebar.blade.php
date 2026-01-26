
<div class="d-flex align-items-center justify-content-center mb-3">
    <hr class="w-50 me-3">
    <h3 class="mb-0 fw-bold text-uppercase nowrap">POPULAR</h3>
    <hr class="w-50 ms-3">
    </div>

<div id="blog-popular-list">
    @include('bootstrap.parts.blog-popular-items', ['popular' => $popular])
</div>

@if ($popular->count() > 0 && !empty($popularHasMore) && $popularHasMore)
    <div class="d-flex justify-content-center mt-3">
        <button id="blog-popular-load-more"
                class="btn btn-dark px-3 d-flex align-items-center w-fit-content"
                data-next-page="2"
                data-exclude-id="{{ isset($blog) ? $blog->id : '' }}">
            <span class="lh-1">Load More</span>
            <i class="iconify fs-5 ms-1" data-icon="eva:arrow-down-fill"></i>
        </button>
    </div>
@endif

<div class="d-flex align-items-center justify-content-center mt-5 mb-3">
    <hr class="w-50 me-3">
    <h3 class="mb-0 fw-bold text-uppercase nowrap">BUY BY PRODUCT</h3>
    <hr class="w-50 ms-3">
</div>
@foreach ($brands as $brand)
    <a class="w-100 btn btn-dark mb-2" href="{{ route('collections', 'brand.' . $brand->brand_code) }}">
        {{ $brand->brand_title }}
    </a>
@endforeach

@once
    @push('scripts')
    <script>
        $(document).ready(function () {
            const $loadMoreBtn = $('#blog-popular-load-more');
            if (!$loadMoreBtn.length) {
                return;
            }

            let isLoading = false;

            $loadMoreBtn.on('click', function (e) {
                e.preventDefault();
                if (isLoading) return;

                const nextPage = $(this).data('next-page') || 2;
                const excludeId = $(this).data('exclude-id') || '';
                const $btn = $(this);

                isLoading = true;
                $btn.prop('disabled', true).addClass('disabled');

                $.get("{{ route('blog.popular') }}", { page: nextPage, exclude_id: excludeId }, function (response) {
                    if (response.html) {
                        $('#blog-popular-list').append(response.html);
                    }

                    if (response.has_more) {
                        $btn.data('next-page', response.next_page);
                        $btn.prop('disabled', false).removeClass('disabled');
                        isLoading = false;
                    } else {
                        $btn.remove();
                    }
                }).fail(function () {
                    $btn.prop('disabled', false).removeClass('disabled');
                    isLoading = false;
                });
            });
        });
    </script>
    @endpush
@endonce

