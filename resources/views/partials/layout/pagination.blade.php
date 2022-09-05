@if ($paginator->lastPage() > 1)
<ul class="pagination">
    <li class="page-item previous {{ ($paginator->currentPage() == 1) ? 'disabled' : '' }}">
        <span class="page-link page-text">
            <a href="{{ ($paginator->currentPage() == 1) ? '#' : $paginator->url(1) }}">
                Previous
            </a>
        </span>
    </li>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="page-item {{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
            <a class="page-link" href="{{ ($paginator->currentPage() == $i) ? '#' :$paginator->url($i)}}">{{ $i }}</a>
        </li>
    @endfor
    <li class="page-item next {{ ($paginator->currentPage() == $paginator->lastPage()) ? 'disabled' : '' }}">
        <span class="page-link page-text">
            <a href="{{ ($paginator->currentPage() == $paginator->lastPage()) ? '#' : $paginator->url($paginator->currentPage()+1) }}">
                Next
            </a>
        </span>
    </li>
</ul>
@endif

