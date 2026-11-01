{{-- Rebuild window: Laravel UrlWindow shows ALL pages when lastPage < onEachSide*2+8 --}}
@php
    $side = max(0, (int) ($paginator->onEachSide ?? 2));
    $current = $paginator->currentPage();
    $last = $paginator->lastPage();
    $start = max(1, $current - $side);
    $end = min($last, $current + $side);

    $elements = [];
    if ($start > 1) {
        $elements[] = $paginator->getUrlRange(1, 1);
        if ($start > 2) {
            $elements[] = '...';
        }
    }
    $elements[] = $paginator->getUrlRange($start, $end);
    if ($end < $last) {
        if ($end < $last - 1) {
            $elements[] = '...';
        }
        $elements[] = $paginator->getUrlRange($last, $last);
    }
@endphp

@if ($paginator->hasPages())
    <nav>
        <ul class="pagination flex-wrap justify-content-center mb-0">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
