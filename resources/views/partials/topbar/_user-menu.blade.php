<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img alt="Logo" src="{{ auth()->user()->gravatar_url }}"/>
            </div>
            <!--end::Avatar-->

            <!--begin::Username-->
            <div class="d-flex flex-column">
                <div class="fw-bolder d-flex align-items-center fs-5">
                    {{ auth()->user()->name }}
                    <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span>
                </div>
                <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
            </div>
            <!--end::Username-->
        </div>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->

    <!--begin::Menu item-->
    {{-- <div class="menu-item px-5">
        <a href="{{ theme()->getPageUrl('settings.index') }}" class="menu-link px-5">
            {{ __('My Profile') }}
        </a>
    </div> --}}
    <!--end::Menu item-->

    <x-ladmin-toprightmenu />

    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->

    <!--begin::Menu item-->
    {{-- <div class="menu-item px-5 my-1">
        <a href="{{ theme()->getPageUrl('settings.index') }}" class="menu-link px-5">
            {{ __('Account Settings') }}
        </a>
    </div> --}}
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="javascript:void(0);" onclick="document.getElementById('ladmin-logout').submit()" class="button-ajax menu-link px-5">
            {{ __('Sign Out') }}
        </a>
    </div>
    <form action="{{ route('administrator.logout') }}" id="ladmin-logout" method="post">@csrf</form>
    <!--end::Menu item-->
</div>
<!--end::Menu-->
