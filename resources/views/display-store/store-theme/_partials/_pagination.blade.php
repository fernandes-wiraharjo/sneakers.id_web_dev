<div>
    @if ($paginator->hasPages())
    @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

        <div class="ProductForm__QuantitySelector">
            <div class="QuantitySelector QuantitySelector--large">
                @if ($paginator->onFirstPage())
                    <span class="QuantitySelector__Button Link Link--secondary">
                        <button disabled><<</button>
                        {{-- <a href="{{ ($paginator->currentPage() == 1) ? '#' : $paginator->url(1) }}"><<</a> --}}
                    </span>
                @else
                    <button type="button" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="prev" ><<</button>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                     {{-- Array Of Links --}}
                     @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a class="page-item active" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}" aria-current="page">
                                    {{ $page }}
                                </a>
                            @else
                                <a class="page-item" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}">
                                    <button type="button" class="page-link" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}
                                    </button>
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                    <button style="padding: 10px 10px;"></button>
                    <a href="{{ ($paginator->currentPage() == $i) ? '#' :$paginator->url($i)}}" style="padding: 10px 10px;">{{ $i }}</a>
                @endfor
                <span class="QuantitySelector__Button Link Link--secondary">
                    <a href="{{ ($paginator->currentPage() == $paginator->lastPage()) ? '#' : $paginator->url($paginator->currentPage()+1) }}" >>></a>
                </span>
            </div>
        </div>
    @endif
</div>

