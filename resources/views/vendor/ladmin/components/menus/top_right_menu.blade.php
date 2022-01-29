
@foreach ($menu->topRright as $menu)
<!--begin::Menu item-->
@if(in_array($menu['gate'], $permissions))
    @php
    $router = 'javascript:void(0);';
    if($menu['route']) {
        $route = $menu['route'][0];
        $params = $menu['route'][1] ?? [];
        $router = route($route, $params);
    }
    @endphp
    <div class="menu-item px-5">
        <a href="{{ $router }}" class="menu-link px-5" data-bs-toggle="tooltip" data-bs-placement="left"">
            <span class="menu-text">{{ __($menu['name']) }}</span>

        </a>
    </div>
@endif
<!--end::Menu item-->
@endforeach