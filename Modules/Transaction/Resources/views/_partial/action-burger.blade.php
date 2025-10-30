<a href="#" class="btn btn-info btn-active-light-primary btn-sm m-1"
    data-bs-toggle="modal" data-bs-target="#action-detail-{{ $transaction->id }}">
    <i class="fas fa-eye"></i> Detail
</a>
@if ($transaction->status == 'SUCCESS')
<a href="#" class="btn btn-warning btn-active-light-primary btn-sm m-1"
    data-bs-toggle="modal" data-bs-target="#action-shipping-{{ $transaction->id }}" onclick="openModal({{ $transaction->id }})">
    <i class="fas fa-truck"></i> Shipping
</a>
@endif
<a href="#" class="btn btn-danger btn-active-light-primary btn-sm m-1"
    data-bs-toggle="modal" data-bs-target="#action-history-{{ $transaction->id }}">
    <i class="fa fa-reply"></i> History
</a>
@if (in_array($transaction->status, ['SUCCESS', 'COMPLETED']))
<a href="#" class="btn btn-primary btn-active-light-primary btn-sm m-1"
    data-bs-toggle="modal" data-bs-target="#action-refund-{{ $transaction->id }}">
    <i class="fas fa-undo"></i> Refund
</a>
@endif

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
                                <input type="text" name="shipping_waybill" class="form-control form-control-solid me-3 flex-grow-1 shipping-waybill-{{ $transaction->id }}" placeholder="Masukkan Resi" value="{{ old('resi', $shipping ? $shipping->shipping_waybill : '' )}}" onkeyup="fieldResi({{ $transaction->id }})" />
                                <input type="hidden" class="csrf-token-{{ $transaction->id }}" value="{{ csrf_token() }}">
                                <button type="button" id="shipping-waybill-{{ $transaction->id }}" class="btn btn-primary fw-bold flex-shrink-0"  onclick="checkResi({{ $transaction->id }})" {{$shipping ? ($shipping->shipping_waybill ? '' : 'disabled') : ''}}>Cek Resi</button>
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
                                </tbody>
                            </table>
                        </div>
                        <h5>Recipient Information</h5>
                        <div class="table-responsive" style="text-align: left;">
                            <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                                <tbody>
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
                        <h5>User Information</h5>
                        <div class="table-responsive" style="text-align: left;">
                            <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                                <tbody>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $user_info->email ?? "-" }}</td>
                                    </tr>
                                    <tr>
                                        <td>User Name</td>
                                        <td>{{ $user_info->first_name ?? "" }} {{ $user_info->last_name ?? "" }}</td>
                                    </tr>
                                    @if($user_address != null)
                                    <tr>
                                        <td>User Address</td>
                                        <td>{{ $user_address->address ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>User Region</td>
                                        <td>
                                            <span>{{ $region->area ?? '-' }}</span> <br>
                                            <span>{{ $region->subdistrict ?? '-' }}</span> <br>
                                            <span>{{ $region->district ?? '-' }}</span> <br>
                                            <span>{{ $region->province ?? '-' }}</span> <br>
                                            <span>{{ $region->post_code ?? '-' }}</span> <br>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        Address not set.
                                    </tr>
                                    @endif
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
    <div class="modal-dialog modal-xl">
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
                                            <td>
                                                @php
                                                    $status = $transaction->status ?? '-';
                                                    $badgeClass = match($status) {
                                                        'PENDING' => 'badge-warning',
                                                        'SUCCESS' => 'badge-success',
                                                        'COMPLETED' => 'badge-primary',
                                                        'REFUNDED' => 'badge-danger',
                                                        'CANCELLED' => 'badge-dark',
                                                        'FAILED' => 'badge-danger',
                                                        'EXPIRED' => 'badge-secondary',
                                                        default => 'badge-light',
                                                    };
                                                @endphp
                                                <span class="badge {{ $badgeClass }} fs-7">{{ $status }}</span>
                                            </td>
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
                                            <td>Customer Note</td>
                                            <td>{{ $transaction->description ?? "-" }}</td>
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
                                    <td style="width: 100px;">Size</td>
                                    <td style="width: 200px;">Quantity x Price</td>
                                    <td style="width: 100px;">Product Subtotal</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr class="align-middle">
                                    <td><img src="{{ getImage($item->detail->product->image ?? '' , 'products/'.$item->detail->product->product_code) }}" alt="" class="w-6 rounded" style="width: 75px"/></td>
                                    <td>{{ $item->detail->product->product_code }}</td>
                                    <td>{{ $item->detail->product->product_name }}</td>
                                    <td>{{ $item->detail->size }}</td>
                                    <td>{{ $item->quantity }} x Rp {{ rupiah_format($item->price ?? 0) }}</td>
                                    <td>Rp {{ rupiah_format($item->quantity * $item->price ?? 0) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4"></td>
                                    <td>Subtotal</td>
                                    <td>Rp {{ rupiah_format($transaction->sub_total ?? 0) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td>Shipping Cost {{ $shipping->shipping_method ?? '-' }}</td>
                                    <td>Rp {{ rupiah_format($shipping->shipping_cost ?? 0) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td>Grand Total</td>
                                    <td>Rp {{ rupiah_format($transaction->grand_total ?? 0) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Refund Information Section --}}
                @if($transaction->status == 'REFUNDED' && $transaction->refund)
                <div class="mb-10">
                    <div class="alert alert-warning">
                        <strong><i class="fas fa-exclamation-triangle"></i> This transaction has been refunded</strong>
                    </div>
                    
                    <h5>Refund Information</h5>
                    <div class="table-responsive" style="text-align: left;">
                        <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                            <tbody>
                                <tr>
                                    <td style="width: 200px;">Bank Name</td>
                                    <td>{{ $transaction->refund->bank_name }}</td>
                                </tr>
                                <tr>
                                    <td>Account Number</td>
                                    <td>{{ $transaction->refund->account_number }}</td>
                                </tr>
                                <tr>
                                    <td>Account Holder</td>
                                    <td>{{ $transaction->refund->account_holder_name }}</td>
                                </tr>
                                <tr>
                                    <td>Refund Amount</td>
                                    <td><strong class="text-danger">Rp {{ number_format($transaction->refund->amount, 0, ',', '.') }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Reason</td>
                                    <td>{{ $transaction->refund->reason ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Processed By</td>
                                    <td>{{ $transaction->refund->processedBy->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Processed At</td>
                                    <td>{{ $transaction->refund->processed_at ? $transaction->refund->processed_at->format('d-m-Y H:i') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Refund Created At</td>
                                    <td>{{ $transaction->refund->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if($transaction->refund->proof_image)
                    <h5 class="mt-5">Transfer Proof</h5>
                    <div class="text-center">
                        <img src="{{ url('refunds/' . $transaction->refund->proof_image) }}" alt="Transfer Proof" style="max-width: 100%; max-height: 400px;" class="img-thumbnail">
                    </div>
                    @endif
                </div>
                @endif

                {{-- Shipping Information Section for Shipped Orders --}}
                @if($shipping && $shipping->shipping_waybill)
                <div class="mb-10">
                    <div class="alert alert-info">
                        <strong><i class="fas fa-shipping-fast"></i> This order has been shipped</strong>
                    </div>
                    
                    <h5>Shipping Information</h5>
                    <div class="table-responsive" style="text-align: left;">
                        <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                            <tbody>
                                <tr>
                                    <td style="width: 200px;">Shipping Status</td>
                                    <td><strong>{{ $shipping->status ?? '-' }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Courier</td>
                                    <td>{{ $shipping->shipping_method ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Courier Code</td>
                                    <td>{{ strtoupper($shipping->courier_code ?? '-') }}</td>
                                </tr>
                                <tr>
                                    <td>Tracking Number (Resi)</td>
                                    <td><strong class="text-primary">{{ $shipping->shipping_waybill }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Shipping Cost</td>
                                    <td>Rp {{ rupiah_format($shipping->shipping_cost ?? 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping Address</td>
                                    <td>
                                        {{ $destination->address ?? '-' }}<br>
                                        {{ $destination->region->area ?? '-' }}, {{ $destination->region->subdistrict ?? '-' }}<br>
                                        {{ $destination->region->district ?? '-' }}, {{ $destination->region->province ?? '-' }}<br>
                                        {{ $destination->region->post_code ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Recipient</td>
                                    <td>
                                        {{ $destination->first_name ?? '' }} {{ $destination->last_name ?? '' }}<br>
                                        {{ $destination->phone_number ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $shipping->updated_at ? $shipping->updated_at->format('d-M-Y H:i') : '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Refund Modal --}}
<div class="modal fade" tabindex="-1" id="action-refund-{{ $transaction->id }}" aria-labelledby="action-Label-refund-{{ $transaction->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            @if(!$transaction->refund)
            <form action="{{ route('administrator.transaction.refund.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="action-refund-label">Process Refund - {{ $transaction->token ?? '-'}}</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                    
                    <div class="mb-10">
                        <h5>Transaction Information</h5>
                        <div class="table-responsive" style="text-align: left;">
                            <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                                <tbody>
                                    <tr>
                                        <td style="width: 200px;">Order ID</td>
                                        <td>{{ $transaction->token ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Grand Total</td>
                                        <td>Rp {{ rupiah_format($transaction->grand_total ?? 0) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            @php
                                                $txStatus = $transaction->status ?? '-';
                                                $txBadgeClass = match($txStatus) {
                                                    'PENDING' => 'badge-warning',
                                                    'SUCCESS' => 'badge-success',
                                                    'COMPLETED' => 'badge-primary',
                                                    'REFUNDED' => 'badge-danger',
                                                    'CANCELLED' => 'badge-dark',
                                                    'FAILED' => 'badge-danger',
                                                    'EXPIRED' => 'badge-secondary',
                                                    default => 'badge-light',
                                                };
                                            @endphp
                                            <span class="badge {{ $txBadgeClass }} fs-7">{{ $txStatus }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Customer</td>
                                        <td>{{ $destination->first_name ?? '' }} {{ $destination->last_name ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mb-10">
                        <label for="bank_name" class="form-label required">Bank Name</label>
                        <input type="text" name="bank_name" id="bank_name" class="form-control form-control-solid" placeholder="Enter bank name" required value="{{ old('bank_name') }}">
                    </div>

                    <div class="mb-10">
                        <label for="account_number" class="form-label required">Account Number</label>
                        <input type="text" name="account_number" id="account_number" class="form-control form-control-solid" placeholder="Enter account number" required value="{{ old('account_number') }}">
                    </div>

                    <div class="mb-10">
                        <label for="account_holder_name" class="form-label required">Account Holder Name</label>
                        <input type="text" name="account_holder_name" id="account_holder_name" class="form-control form-control-solid" placeholder="Enter account holder name" required value="{{ old('account_holder_name') }}">
                    </div>

                    <div class="mb-10">
                        <label for="amount" class="form-label required">Refund Amount (Rp)</label>
                        <input type="number" name="amount" id="amount" class="form-control form-control-solid" placeholder="Enter refund amount" required step="0.01" min="0" max="{{ $transaction->grand_total }}" value="{{ old('amount', $transaction->grand_total) }}">
                        <div class="form-text">Maximum: Rp {{ rupiah_format($transaction->grand_total ?? 0) }}</div>
                    </div>

                    <div class="mb-10">
                        <label for="proof_image" class="form-label">Transfer Proof Image</label>
                        <input type="file" name="proof_image" id="proof_image" class="form-control form-control-solid" accept="image/*">
                        <div class="form-text">Upload proof of transfer (JPEG, PNG, JPG, GIF - Max 2MB) - Will be converted to WebP</div>
                    </div>

                    <div class="mb-10">
                        <label for="reason" class="form-label">Refund Reason</label>
                        <textarea name="reason" id="reason" class="form-control form-control-solid" rows="3" placeholder="Enter refund reason">{{ old('reason') }}</textarea>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Refund</button>
                </div>
            </form>
            @else
            {{-- Display existing refund information --}}
            <div class="modal-header border-0">
                <h5 class="modal-title" id="action-refund-label">Refund Details - {{ $transaction->token ?? '-'}}</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <div class="modal-body">
                <div class="mb-10">
                    <h5>Transaction Information</h5>
                    <div class="table-responsive" style="text-align: left;">
                        <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                            <tbody>
                                <tr>
                                    <td style="width: 200px;">Order ID</td>
                                    <td>{{ $transaction->token ?? '-'}}</td>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <td>Rp {{ rupiah_format($transaction->grand_total ?? 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        @php
                                            $refundTxStatus = $transaction->status ?? '-';
                                            $refundTxBadgeClass = match($refundTxStatus) {
                                                'PENDING' => 'badge-warning',
                                                'SUCCESS' => 'badge-success',
                                                'COMPLETED' => 'badge-primary',
                                                'REFUNDED' => 'badge-danger',
                                                'CANCELLED' => 'badge-dark',
                                                'FAILED' => 'badge-danger',
                                                'EXPIRED' => 'badge-secondary',
                                                default => 'badge-light',
                                            };
                                        @endphp
                                        <span class="badge {{ $refundTxBadgeClass }} fs-7">{{ $refundTxStatus }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="alert alert-success">
                    <strong><i class="fas fa-check-circle"></i> Refund Processed</strong>
                </div>

                <div class="mb-10">
                    <h5>Refund Information</h5>
                    <div class="table-responsive" style="text-align: left;">
                        <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                            <tbody>
                                <tr>
                                    <td style="width: 200px;">Bank Name</td>
                                    <td>{{ $transaction->refund->bank_name }}</td>
                                </tr>
                                <tr>
                                    <td>Account Number</td>
                                    <td>{{ $transaction->refund->account_number }}</td>
                                </tr>
                                <tr>
                                    <td>Account Holder</td>
                                    <td>{{ $transaction->refund->account_holder_name }}</td>
                                </tr>
                                <tr>
                                    <td>Refund Amount</td>
                                    <td><strong>Rp {{ number_format($transaction->refund->amount, 0, ',', '.') }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Reason</td>
                                    <td>{{ $transaction->refund->reason ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Processed By</td>
                                    <td>{{ $transaction->refund->processedBy->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Processed At</td>
                                    <td>{{ $transaction->refund->processed_at ? $transaction->refund->processed_at->format('d-M-Y H:i') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $transaction->refund->created_at->format('d-M-Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($transaction->refund->proof_image)
                <div class="mb-10">
                    <h5>Transfer Proof</h5>
                    <div class="text-center">
                        <img src="{{ Storage::url('refunds/' . $transaction->refund->proof_image) }}" alt="Transfer Proof" style="max-width: 100%; max-height: 500px;" class="img-thumbnail">
                    </div>
                </div>
                @endif
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
            @endif
        </div>
    </div>
</div>
