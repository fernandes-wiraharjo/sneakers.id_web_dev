<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
  @foreach ($items as $item)
    @if($loop->last)
      <li class="breadcrumb-item text-dark">
        {{ $item['name'] }}
      </li>
    @else 
      <li class="breadcrumb-item text-muted">
        <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
      </li>
      <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
      </li>
      @endif
  @endforeach
</ul>