<!--begin::Tables Widget 13-->
<div class="card {{ $class }}">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bolder fs-3 mb-1">Recent Orders</span>

			<span class="text-muted mt-1 fw-bold fs-7">Over {{ $total_order }} orders</span>
		</h3>
        {{-- <div class="card-toolbar">
            <!--begin::Menu-->
            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                {!! theme()->getSvgIcon("icons/duotune/general/gen024.svg", "svg-icon-2") !!}
            </button>
            {{ theme()->getView('partials/menus/_menu-2') }}
            <!--end::Menu-->
        </div> --}}
    </div>
    <!--end::Header-->

	<!--begin::Body-->
	<div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                <!--begin::Table head-->
                <thead>
                    <tr class="fw-bolder text-muted">
                        <th class="w-25px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-13-check"/>
                            </div>
                        </th>
                        <th class="min-w-150px">Order Id</th>
                        <th class="min-w-140px">Destination</th>
                        <th class="min-w-120px">Date</th>
                        <th class="min-w-120px">Customer</th>
                        <th class="min-w-120px">Total</th>
                        <th class="min-w-120px">Status</th>
                        {{-- <th class="min-w-100px text-end">Actions</th> --}}
                    </tr>
                </thead>
                <!--end::Table head-->

                <!--begin::Table body-->
                <tbody>
                    @foreach($tableRows as $row)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input widget-13-check" type="checkbox" value="1"/>
                                </div>
                            </td>

                            <td>
                                <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $row['token'] }}</a>
                            </td>

                            <td>
                                <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{ $row['district'] }} - {{ $row['subdistrict'] }}</a>
                                <span class="text-muted fw-bold text-muted d-block fs-7">Code: {{ $row['post_code'] }} {{ $row['province'] }}</span>
                            </td>

                            <td>
                                <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{ $row['date'] }}</a>
                                <span class="text-muted fw-bold text-muted d-block fs-7">Code: {{ $row['type'] }} - {{ $row['method'] }}</span>
                            </td>

                            <td>
                                <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{ $row['first_name'] }} {{ $row['last_name']}}</a>
                                <span class="text-muted fw-bold text-muted d-block fs-7">{{ $row['email'] }}</span>
                            </td>

                            <td class="text-dark fw-bolder text-hover-primary fs-6">
                               Rp. {{ rupiah_format($row['grand_total']) }}
                            </td>

                            <td>
                                <span class="badge badge-light-primary">{{ $row['status'] }}</span>
                            </td>

                            {{-- <td class="text-end">
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen019.svg", "svg-icon-3") !!}
                                </a>

                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    {!! theme()->getSvgIcon("icons/duotune/art/art005.svg", "svg-icon-3") !!}
                                </a>

                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen027.svg", "svg-icon-3") !!}
                                </a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->
	</div>
	<!--begin::Body-->
</div>
<!--end::Tables Widget 13-->
