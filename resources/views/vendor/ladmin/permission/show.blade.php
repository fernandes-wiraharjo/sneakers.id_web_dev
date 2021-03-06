<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Assign Permission
    </x-slot>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <form action="{{ route('administrator.access.permission.update', $role->id) }}" method="post">
                @csrf
                @method('PUT')
                @php
                $permissions = $role->gates;
                $viewMenu = function($menus) use (&$viewMenu, $permissions) {
                $html = '';
                foreach($menus as $menu) {
                $html .= view('vendor.ladmin.permission._partials._menus', [
                'menu' => $menu,
                'permissions' => $permissions,
                'viewMenu' => $viewMenu
                ]);
                }
                return $html;
                }
                @endphp

                <h3>Main Menu <small>(sidebar)</small></h3>
                <ul class="list-permissions">
                    {!! $viewMenu($menu->sidebar) !!}
                </ul>

                <div class="mt-4 mb-3"></div>

                <h3>Top Right Menu</h3>
                <ul class="list-permissions">
                    {!! $viewMenu($menu->topRright) !!}
                </ul>

                <div class="text-right">
                    @can('administrator.access.permission.assign')
                    <button type="submit" class="btn btn-primary">Save Permission</button>
                    @endcan
                </div>
            </form>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

</x-base-layout>
