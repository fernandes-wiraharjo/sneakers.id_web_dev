@extends('bootstrap.layout')

@section('title', 'Latest Articles')
@section('description', 'All latest blog articles')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center py-5">
            <a href="javascript:history.back()" class="border bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3 p-2">
                <span class="iconify fs-3" data-icon="stash:arrow-left-duotone"></span>
            </a>
            <h1 class="fw-bold mb-0 text-uppercase">
                Latest Articles
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-8 pe-5">
            <div id="blog-all-list">
                @include('bootstrap.parts.blog-all-items', ['blog_results' => $blog_results])
            </div>

            @if ($blog_results->hasMorePages())
                <div class="d-flex justify-content-center mt-4">
                    <button id="blog-all-load-more"
                            class="btn btn-dark px-4 d-flex align-items-center w-fit-content"
                            data-next-page="{{ $blog_results->currentPage() + 1 }}">
                        <span class="lh-1">Load More</span>
                        <i class="iconify fs-4" data-icon="eva:arrow-down-fill"></i>
                    </button>
                </div>
            @endif
        </div>

        <div class="col-12 col-md-4">
            @include('bootstrap.parts.blog-sidebar', ['popular' => $popular, 'brands' => $brands])
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        const $loadMoreBtn = $('#blog-all-load-more');
        if (!$loadMoreBtn.length) {
            return;
        }

        let isLoading = false;

        $loadMoreBtn.on('click', function (e) {
            e.preventDefault();
            if (isLoading) return;

            const nextPage = $(this).data('next-page');
            if (!nextPage) return;

            isLoading = true;
            const $btn = $(this);
            $btn.prop('disabled', true).addClass('disabled');

            $.get('{{ route('blog.all') }}', { page: nextPage }, function (response) {
                if (response.html) {
                    $('#blog-all-list').append(response.html);
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


