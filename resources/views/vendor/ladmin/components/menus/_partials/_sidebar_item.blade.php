<div
    @if(isset($menu['submenus']))
        data-kt-menu-trigger="click"
    @endif
    class="{{ isset($menu['submenus']) ? 'menu-item menu-accordion' : 'menu-item'}} {{ request()->is( config('ladmin.prefix', 'administrator') . "/" . $menu['isActive']) ? 'here show' : null }}">
    @php
        $router = 'javascript:void(0);';
        if($menu['route']) {
            $route = $menu['route'][0];
            $params = $menu['route'][1] ?? [];
            $router = route($route, $params);
        }
    @endphp
    @if(isset($menu['submenus']))
        <span class="menu-link {{ request()->is( config('ladmin.prefix', 'administrator') . "/" . $menu['isActive']) ? 'active' : null }}">
            <span class="menu-icon">
                @if(isset($menu['icon']))
                    <i class="fas fa-{{ $menu['icon'] }}"></i>
                @endif
            </span>
            <span class="menu-title">{{ $menu['name'] }}</span>
            @if(isset($menu['submenus']))
                <span class="menu-arrow"></span>
            @endif
        </span>
        @if(isset($menu['submenus']))
            <span class="menu-arrow"></span>
            <div class="menu-sub menu-sub-accordion menu-active-bg {{ request()->is( config('ladmin.prefix', 'administrator') . "/" . $menu['isActive']) ? 'show' : null }}"
                kt-hidden-height="117">
                {!! $viewMenu($menu['submenus']) !!}
            </div>
        @endif
    @else
    <a class="menu-link {{ request()->is( config('ladmin.prefix', 'administrator') . "/" . $menu['isActive']) ? 'active' : null }}" href="{{ $router }}" id="{{ $menu['id'] ?? null }}">
        <span class="menu-icon">
            @if(isset($menu['icon']))
                <i class="fas fa-{{ $menu['icon'] }}"></i>
            @endif
        </span>
        <span class="menu-title">{{ $menu['name'] }}</span>
    </a>
    @endif
</div>

