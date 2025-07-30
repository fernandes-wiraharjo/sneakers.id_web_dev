<?php
    // List items
?>


<!--begin::List Widget 4-->
<div class="card {{ $class }}">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bolder text-dark">Sales by Brand</span>

			<span class="text-muted mt-1 fw-bold fs-7">Total sales by sneakers brand</span>
		</h3>

        {{-- <div class="card-toolbar">
            <!--begin::Menu-->
            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                {!! theme()->getSvgIcon("icons/duotune/general/gen024.svg", "svg-icon-2") !!}
            </button>
            {{ theme()->getView('partials/menus/_menu-3') }}
            <!--end::Menu-->
        </div> --}}
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-5">
        @foreach($listRows as $index => $row)
            <?php
                if ($items > 0 && $index > ($items - 1)) {
                    break;
                }
            ?>

            <!--begin::Item-->
            <div class="d-flex align-items-sm-center {{ util()->putIf(next($listRows), 'mb-7') }}">
                <!--begin::Symbol-->
                <div class="symbol symbol-50px me-5">
                    <span class="symbol-label">
                        <img src="{{ getImage($row['image'], 'brand') }}" class="h-50 align-self-center" alt=""/>
                    </span>
                </div>
                <!--end::Symbol-->

                <!--begin::Section-->
                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                    <div class="flex-grow-1 me-2">
                        <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">{{ $row['title'] }}</a>

                        <span class="text-muted fw-bold d-block fs-7">{{ $row['total_product'] }} product sales</span>
                    </div>

                    <span class="badge badge-light fw-bolder my-2">Rp. {{ rupiah_format($row['badge']) }}</span>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Item-->
        @endforeach
    </div>
    <!--end::Body-->
</div>
<!--end::List Widget 4-->
