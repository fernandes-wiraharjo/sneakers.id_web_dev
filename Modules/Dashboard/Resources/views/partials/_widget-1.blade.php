<?php
    // List items
    $color = $color ?? 'primary';
?>

<!--begin::List Widget 1-->
<div class="card {{ $class }}">
    <!--begin::Body-->
    <div class="card-body p-0">
        <!--begin::Header-->
        <div class="px-9 pt-7 card-rounded h-275px w-100 bg-{{ $color }}">
            <!--begin::Heading-->
            <div class="d-flex flex-stack">
                <h3 class="m-0 text-white fw-bolder fs-3">Sales Summary</h3>

                <div class="ms-1">
                    <!--begin::Menu-->
                    <button type="button" class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color-{{ $color }} border-0 me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        {!! theme()->getSvgIcon("icons/duotune/general/gen024.svg", "svg-icon-2") !!}
                    </button>
                    {{ theme()->getView('partials/menus/_menu-3') }}
                    <!--end::Menu-->
                </div>
            </div>
            <!--end::Heading-->

            <!--begin::Balance-->
            <div class="d-flex text-center flex-column text-white pt-8">
                <span class="fw-bold fs-7">Xendit Balance</span>
                <span class="fw-bolder fs-2x pt-1">Rp {{ rupiah_format($xendit_balance) }}</span>
            </div>
            <!--end::Balance-->
        </div>
        <!--end::Header-->

        <!--begin::Items-->
        <div class="shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1 bg-white" style="margin-top: -100px">
            @foreach($listRows as $row)
                <!--begin::Item-->
                <div class="d-flex align-items-center {{ util()->putIf(next($listRows), 'mb-6') }}">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-45px w-40px me-5">
                        <span class="symbol-label bg-lighten">
                            {!! theme()->getSvgIcon($row['icon'], "svg-icon-1") !!}
                        </span>
                    </div>
                    <!--end::Symbol-->

                    <!--begin::Description-->
                    <div class="d-flex align-items-center flex-wrap w-100">
                        <!--begin::Title-->
                        <div class="mb-1 pe-3 flex-grow-1">
                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">{{ $row['title'] }}</a>
                            <div class="text-gray-400 fw-bold fs-7">{{ $row['description'] }}</div>
                        </div>
                        <!--end::Title-->

                        <!--begin::Label-->
                        <div class="d-flex align-items-center">
                            <div class="fw-bolder fs-5 text-gray-800 pe-1">{{ $row['stats'] }}</div>

                            @if(isset($row['arrow']))
                                @if($row['arrow'] === 'up')
                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr066.svg", "svg-icon-5 svg-icon-success ms-1") !!}
                                @else
                                    {!! theme()->getSvgIcon("icons/duotune/arrows/arr065.svg", "svg-icon-5 svg-icon-danger ms-1") !!}
                                @endif
                            @endif
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Item-->
            @endforeach
        </div>
        <!--end::Items-->
    </div>
    <!--end::Body-->
</div>
<!--end::List Widget 1-->
