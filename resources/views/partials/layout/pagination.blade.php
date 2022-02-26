@if ($paginator->lastPage() > 1)
<div class="ProductForm__QuantitySelector">
    <div class="QuantitySelector QuantitySelector--large">
        <span class="QuantitySelector__Button Link Link--secondary">
            <a href="{{ ($paginator->currentPage() == 1) ? '#' : $paginator->url(1) }}"><<</a>
        </span>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <a href="{{ ($paginator->currentPage() == $i) ? '#' :$paginator->url($i)}}" style="padding: 10px 10px;">{{ $i }}</a>
        @endfor
        <span class="QuantitySelector__Button Link Link--secondary">
            <a href="{{ ($paginator->currentPage() == $paginator->lastPage()) ? '#' : $paginator->url($paginator->currentPage()+1) }}" >>></a>
        </span>
    </div>
</div>
@endif
