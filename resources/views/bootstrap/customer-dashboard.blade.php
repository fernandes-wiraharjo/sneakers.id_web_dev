@extends('bootstrap.layout')

@section('title', 'My Account - SNEAKERS.ID')

@push('styles')
<style>
    .order-table-container {
        max-height: 400px;
        overflow-y: auto;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 d-flex align-items-center mb-4">
            <a href="javascript:history.back()" class="border bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3 p-2">
                <span class="iconify fs-3" data-icon="stash:arrow-left-duotone"></span>
            </a>
            <h1 class="fw-bold mb-0">My Account</h1>
        </div>

        <div class="col-12 mb-4">
            <div class="alert alert-info">
                <strong>Welcome back, {{ auth()->user()->name ?? '-' }}</strong>
            </div>
        </div>

        {{-- Email Verification Notice --}}
        @if (!auth()->user()->is_email_verified)
            <div class="col-12 mb-4">
                <div class="alert alert-warning">
                    <h5 class="alert-heading">Verify your email!</h5>
                    <p class="mb-3">Thank you for signing up for our service! To ensure the security and validity of your account, we kindly request you to verify your email address.</p>
                    <a href="{{ route('customer.verify-email', $token) }}" class="btn btn-dark">VERIFY HERE</a>
                </div>
            </div>
        @endif

        {{-- Success Message --}}
        @if ($message = Session::get('success'))
            <div class="col-12 mb-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        {{-- Error Message --}}
        @if ($message = Session::get('error'))
            <div class="col-12 mb-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        {{-- Orders Section --}}
        <div class="col-12 mb-5">
            <div class="card">
                <div class="card-header py-3 bg-dark text-white">
                    <h5 class="mb-0 fw-bold">MY ORDERS</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive order-table-container">
                        <table class="table table-hover mb-0">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th scope="col">ORDER</th>
                                    <th scope="col">DATE</th>
                                    <th scope="col">ORDER STATUS</th>
                                    <th scope="col">TOTAL</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($transaction && $transaction->count() > 0)
                                    @foreach ($transaction as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('customer.transaction.detail', $item->transaction->token) }}" class="text-decoration-none fw-bold">
                                                #{{ strtoupper($item->transaction->token) }}
                                            </a>
                                        </td>
                                        <td>{{ date('d F Y', strtotime($item->transaction->date)) }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($item->transaction->status == 'PENDING' || $item->transaction->status == 'CREATED') bg-warning
                                                @elseif($item->transaction->status == 'PAID' || $item->transaction->status == 'COMPLETED') bg-success
                                                @elseif($item->transaction->status == 'CANCELLED') bg-danger
                                                @else bg-secondary
                                                @endif">
                                                {{ $item->transaction->status }}
                                            </span>
                                        </td>
                                        <td class="fw-semibold">{{ rupiah_format(intval($item->transaction->grand_total), true) }}</td>
                                        <td>
                                            @if ($item->transaction->status == 'PENDING' || $item->transaction->status == 'CREATED')
                                                <a href="{{ $item->transaction->snap_payment_url }}" class="btn btn-dark btn-sm px-5">PAY</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">No orders found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Address Section --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header py-3 bg-dark text-white">
                    <h5 class="mb-0 fw-bold">SAVED ADDRESS</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Name:</strong> {{ $user_info->name ?? '-' }}
                    </div>
                    @if($user_address != null)
                    @php $loc = $saved_location ?? shipping_location($user_address); @endphp
                    <div class="mb-2">
                        <strong>Address:</strong><br>
                        {{ $user_address->address ?? '-' }}
                    </div>
                    <div class="mb-2">
                        <strong>Region:</strong><br>
                        {{ $loc['subdistrict'] ?? '-' }}, {{ $loc['district'] ?? '-' }}<br>
                        {{ $loc['city'] ?? '-' }}, {{ $loc['province'] ?? '-' }}<br>
                        {{ $loc['postal_code'] ?? '-' }}
                    </div>
                    @if($user_address->phone_number)
                    <div class="mb-2">
                        <strong>Phone:</strong> {{ $user_address->phone_number }}
                    </div>
                    @endif
                    @else
                    <div class="text-muted">
                        Address not set.
                    </div>
                    @endif
                    <button type="button" class="btn btn-dark mt-3 px-5" data-bs-toggle="modal" data-bs-target="#editAddressModal">
                        EDIT
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Edit Address Modal --}}
<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAddressModalLabel">EDIT ACCOUNT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('customer.address.save') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="text-muted mb-4">Please fill information below:</p>

                    <div class="mb-3">
                        <label for="first_name" class="form-label fw-semibold">FIRST NAME</label>
                        <input type="text" 
                               class="form-control" 
                               id="first_name" 
                               name="first_name" 
                               placeholder="First Name" 
                               value="{{ old('first_name', split_name($user_info->name)[0]) }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label fw-semibold">LAST NAME</label>
                        <input type="text" 
                               class="form-control" 
                               id="last_name" 
                               name="last_name" 
                               placeholder="Last Name" 
                               value="{{ old('last_name', split_name($user_info->name)[1]) }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label fw-semibold">PHONE NUMBER</label>
                        <input type="text" 
                               class="form-control" 
                               id="phone_number" 
                               name="phone_number" 
                               placeholder="Phone Number" 
                               value="{{ old('phone_number', $user_address->phone_number ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label fw-semibold">ADDRESS</label>
                        <textarea class="form-control" 
                                  id="address" 
                                  name="address" 
                                  rows="3" 
                                  placeholder="Address">{{ old('address', $user_address->address ?? '') }}</textarea>
                    </div>

                    @livewire('region', ['user_address' => $user_address])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Bootstrap modal is handled automatically by Bootstrap JS
    // No custom JavaScript needed as Bootstrap handles the modal functionality
</script>
@endpush

