@php
  $rand = rand();
@endphp
{{-- <li style="border-left:solid 1px #ddd;"> --}}
<div class="form-check form-check-custom form-check-solid row">
    <div class="col-sm-6">
        <input class="permission-checkbox form-check-input" type="checkbox" id="{{ $rand }}" {{ in_array($menu['gate'], $permissions) ? 'checked' : null }} name="gates[]" value="{{ $menu['gate'] }}">
        <label class="form-check-label" for="{{ $rand }}" style="cursor:pointer;">
            <strong>{{ $menu['name'] ?? $menu['title'] }}</strong>
            <p class="mb-0 text-muted">{{ $menu['description'] ?? null }}</p>
        </label>
    </div>
  @if(isset($menu['submenus']))
    <div style="margin-left: 10%">
         {!! $viewMenu($menu['submenus']) !!}
    </div>
  @endif

  @if(isset($menu['gates']) && count($menu['gates']) > 0)

    <button  style="text-decoration:none; width:20%;" type="button" class="btn ml-4 mb-3  btn-light btn-sm text-right" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $rand }}">
      <strong>Open Permission <i class="fas fa-caret-down float-right"></i></strong>
    </button>
    <div class="collapse" id="collapse-{{ $rand }}">
        <div style="margin-left: 10%">
            {!! $viewMenu($menu['gates']) !!}
        </div>
    </div>
  @endif
</div>
{{-- </li> --}}
