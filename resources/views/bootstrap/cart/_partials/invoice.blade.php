<div id="step4" style="display: {{ $currentStep != 4 ? 'none' : '' }}">
    @if($invoiceUrl != [])
        <!-- Cancel Transaction Button -->
        <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#cancelModal">
            Cancel Transaction
        </button>

        <!-- Cancel Confirmation Modal -->
        <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelModalLabel">Confirm Cancellation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to cancel this transaction? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Keep It</button>
                        <form action="{{ route('customer.transaction.cancel', $invoiceUrl['args']['transaction_details']['order_id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Yes, Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @isset($invoiceUrl['message'])
                    <div class="alert alert-info">
                        {{ $invoiceUrl['message'] }}
                    </div>
                    <div class="mb-3">
                        <a href="#" class="btn btn-outline-secondary" wire:click="back(3)">
                            <span class="iconify me-2" data-icon="material-symbols:arrow-back"></span>
                            Return to payment
                        </a>
                    </div>
                @endisset
                
                @isset($invoiceUrl['invoice_url'])
                    <div class="ratio" style="--bs-aspect-ratio: 125%;">
                        <iframe id="iframe-invoice" class="rounded" title="Invoice" src="{{ $invoiceUrl['invoice_url'] }}" style="width: 100%; height: 800px; border: none;"></iframe>
                    </div>
                @endisset
            </div>
        </div>
    @endif
</div>

