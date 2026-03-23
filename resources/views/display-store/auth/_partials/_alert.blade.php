@if ($errors->any())
    <p class="Form__Alert Alert Alert--error">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </p>
@endif

@foreach ($status as $state)
    @if(session()->has($state))
    <p class="Form__Alert Alert Alert--{{ $state }}">
        @foreach (session()->get($state) as $item)
            {!! $item !!}<br>
        @endforeach
    </p>
    @endif
@endforeach
