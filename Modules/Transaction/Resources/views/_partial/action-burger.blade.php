<a href="#" class="btn btn-info btn-active-light-primary btn-sm m-1"
    data-bs-toggle="modal" data-bs-target="#action-detail-{{ $transaction->id }}">
    <i class="fas fa-eye"></i> Detail
</a>

<a href="#" class="btn btn-warning btn-active-light-primary btn-sm m-1"
    data-bs-toggle="modal" data-bs-target="#action-shipping-{{ $transaction->id }}">
    <i class="fas fa-truck"></i> Shipping
</a>

<a href="#" class="btn btn-danger btn-active-light-primary btn-sm m-1"
    data-bs-toggle="modal" data-bs-target="#action-history-{{ $transaction->id }}">
    <i class="fa fa-reply"></i> History
</a>

<div class="modal fade" tabindex="-1" id="action-shipping-{{ $transaction->id }}" aria-labelledby="action-Label-shipping-{{ $transaction->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('administrator.transaction.resi') }}" method="post">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="action-1Label">Update Shipping</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="mb-15">
                        <h4>ORDER SHIPPING</h4>
                        <h5>{{ $transaction->token?? '-'}}</h5>
                    </div>
                    <input type="hidden" name="id" value="{{ $shipping->id ?? '' }}">
                    <div class="mb-10 text-left">
                        <label for="exampleFormControlInput1" class="form-label">Resi</label>
                        <div class="w-100">
                            <div class="d-flex">
                                <input type="text" name="shipping_waybill" class="form-control form-control-solid me-3 flex-grow-1 shipping-waybill-{{ $transaction->id }}" placeholder="Masukkan Resi" value="{{ old('resi', $shipping->shipping_waybill ?? '' )}}"/>
                                <input type="hidden" class="csrf-token-{{ $transaction->id }}" value="{{ csrf_token() }}">
                                <a href="#" id="shipping-waybill-{{ $transaction->id }}" class="btn btn-primary fw-bold flex-shrink-0"  onclick="checkResi({{ $transaction->id }})">Cek Resi</a>
                            </div>
                        </div>
                    </div>
                    <span class="indicator-progress loading-spinner-{{ $transaction->id }} m-10">
                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                    <div class="mb-10 description-check-resi-{{ $transaction->id }}" style="display: none;">
                        <h5>Check Resi</h5>
                    </div>

                    <div class="mb-10 check-resi-{{ $transaction->id }}" style="display: none;">
                        <h5>Check Resi</h5>
                        <div class="response-container container---{{ $transaction->id }}">
                            <div class="response-summary summary--{{ $transaction->id }}"></div>
                            <div class="timeline">
                                <div class="outer manifest-timeline timeline--{{ $transaction->id }}">

                                </div>
                              <!-- Manifest items will be appended here -->
                            </div>
                        </div>
                    </div>

                    <div class="mb-10 text-left">
                        <label for="select-status" class="form-label">Order Status</label>
                        <!--begin::Row-->
                        <div class="row mw-500px mb-5" data-kt-buttons="true" data-kt-buttons-target=".form-check-image, .form-check-input">
                            <div class="col-4">
                                <label class="form-check-label">
                                    Complete
                                </label>
                            </div>
                            <!--begin::Col-->
                            <div class="col-4">
                                <label class="form-check-image active">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" value="1" name="complete" {{ $transaction->status == 'COMPLETED' ? 'checked' : '' }} {{ $transaction->status == 'COMPLETED' ? 'disabled' : '' }}/>
                                        <div class="form-check-label">
                                            Yes
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-4">
                                <label class="form-check-image">
                                    <div class="form-check form-check-custom form-check-solid me-10">
                                        <input class="form-check-input" type="radio" {{ $transaction->status != 'COMPLETED' ? 'checked' : '' }} value="0" name="complete" id="text_wow" {{ $transaction->status == 'COMPLETED' ? 'disabled' : '' }}/>
                                        <div class="form-check-label">
                                            No
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <!--end::Col-->

                        </div>
                        <!--end::Row-->
                    </div>

                    {{-- <div class="mb-10 text-left">
                        <label for="select-status" class="form-label">Shipping Status</label>
                        <select class="form-select form-select-solid" name="status" aria-label="Select status" id="select-status">
                            <option value="DIKEMAS" {{ $shipping->status ?? '' == 'DIKEMAS' ? 'selected' : ''}}>DIKEMAS</option>
                            <option value="DIKIRIM" {{ $shipping->status ?? '' == 'DIKIRIM' ? 'selected' : ''}}>DIKIRIM</option>
                            <option value="SEDANG DIKIRIM" {{ $shipping->status ?? '' == 'SEDANG DIKIRIM' ? 'selected' : ''}}>SEDANG DIKIRIM</option>
                            <option value="COMPLETE" {{ $shipping->status ?? '' == 'COMPLETE' ? 'selected' : ''}}>COMPLETE</option>
                        </select>
                    </div> --}}

                    <div class="mb-10">
                    <h5>Shipping Information</h5>
                    @if($shipping)
                        <div class="table-responsive" style="text-align: left;">
                            <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                                <tbody>
                                    <tr>
                                        <td style="width: 200px;">Order Status</td>
                                        <td>{{ $transaction->status?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 200px;">Shipping Status</td>
                                        <td>{{ $shipping->status?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td >Transactions Created At</td>
                                        <td>{{ $transaction->created_at ? $transaction->created_at->format('d-m-Y H:i') : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $destination->email ?? "-" }}</td>
                                    </tr>
                                    <tr>
                                        <td>Customer Name</td>
                                        <td>{{ $destination->first_name ?? "" }} {{ $destination->last_name ?? "" }}</td>
                                    </tr>
                                    <tr>
                                        <td>Customer Address</td>
                                        <td>{{ $destination->address ?? "-" }}</td>
                                    </tr>
                                    <tr>
                                        <td>Customer Phone Number</td>
                                        <td>{{ $destination->phone_number ?? "-" }}</td>
                                    </tr>
                                    <tr>
                                        <td>Customer Region</td>
                                        <td>
                                            {{ $destination->region->province ?? '-'}} <br>
                                            {{ $destination->region->district ?? '-'}} <br>
                                            {{ $destination->region->subdistrict ?? '-'}} <br>
                                            {{ $destination->region->area ?? '-'}} <br>
                                            {{ $destination->region->post_code ?? '-'}} <br>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Courier</th>
                                        <th>{{ $shipping->shipping_method ?? '-'}}</th>
                                    </tr>
                                    <tr>
                                        <td>Cost</td>
                                        <td>{{ $shipping->shipping_cost ? 'Rp '.rupiah_format($shipping->shipping_cost) : '-' }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    @endif
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" {{ $transaction->status == 'COMPLETED' ? 'disabled' : '' }}>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="action-history-{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="action-Label-history-{{ $transaction->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="action-1Label">Transaction History Information</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="mb-10">
                    <div class="table-responsive" style="text-align: left;">
                        <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                    <td style="width: 150px;">Order Status</td>
                                    <td>Response Code</td>
                                    <td>Response Message</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $item)
                                <tr>
                                    <td>{{ $item->response_status == 'DELIVERED' ? 'COMPLETED' : $item->response_status}}</td>
                                    <td>{{ $item->response_code ?? '-'}}</td>
                                    <td>{{ $item->response_message ?? '-'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="action-detail-{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="action-Label-detail-{{ $transaction->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="action-1Label">Order Detail {{ $transaction->token?? '-'}}</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="mb-10">
                    <h5>Item Details</h5>
                    <div class="table-responsive" style="text-align: left;">
                        <div class="gy-7 gs-7">
                            @if($shipping)
                            <div class="table-responsive" style="text-align: left;">
                                <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                                    <tbody>
                                        <tr>
                                            <td style="width: 200px;">Order Payment ID</td>
                                            <td>{{ $transaction->doc_no ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px;">Order ID</td>
                                            <td>{{ $transaction->token?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px;">Order Status</td>
                                            <td>{{ $transaction->status?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td >Order Created At</td>
                                            <td>{{ $transaction->created_at ? $transaction->created_at->format('d-m-Y H:i') : '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px;">Payment Type</td>
                                            <td>{{ $transaction->type ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px;">Payment Method</td>
                                            <td>{{ $transaction->method ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px;">Invoice</td>
                                            <td><a href="{{ $transaction->invoice_url ?? '-'}}" target="_blank" class="btn btn-sm btn-secondary"><i class="fa fa-file-invoice"></i>Invoice Link</a></td>
                                        </tr>
                                        <tr>
                                            <td>Customer Email</td>
                                            <td>{{ $user_info->email ?? "-" }}</td>
                                        </tr>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>{{ $user_info->first_name ?? "" }} {{ $user_info->last_name ?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <td>Recipient Email</td>
                                            <td>{{ $destination->email ?? "-" }}</td>
                                        </tr>
                                        <tr>
                                            <td>Recipient Name</td>
                                            <td>{{ $destination->first_name ?? "" }} {{ $destination->last_name ?? "" }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        </div>
                        <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                    <td style="width: 50px;">Image</td>
                                    <td>Product Code</td>
                                    <td>Product Name</td>
                                    <td style="width: 100px;">Quantity</td>
                                    <td style="width: 100px;">Price</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr class="align-middle">
                                    <td><img src="{{ getImage($item->detail->product->image ?? '' , 'products/'.$item->detail->product->product_code) }}" alt="" class="w-6 rounded" style="width: 75px"/></td>
                                    <td>{{ $item->detail->product->product_code }}</td>
                                    <td>{{ $item->detail->product->product_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ rupiah_format($item->price ?? 0) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"></td>
                                    <td>Subtotal</td>
                                    <td>Rp {{ rupiah_format($transaction->sub_total ?? 0) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td>Shipping Cost {{ $shipping->shipping_method ?? '-' }}</td>
                                    <td>Rp {{ rupiah_format($shipping->shipping_cost ?? 0) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td>Grand Total</td>
                                    <td>Rp {{ rupiah_format($transaction->grand_total ?? 0) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
