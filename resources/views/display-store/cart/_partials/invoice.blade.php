<div id="step4" style="display: {{ $currentStep != 4 ? 'none' : '' }}">
    @if($invoiceUrl != [])

    <!-- Cancel Transaction Button -->
<button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#cancelModal">
    Cancel Transaction
</button>

<!-- Cancel Confirmation Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="cancelModalLabel">Confirm Cancellation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        Are you sure you want to cancel this transaction?
        This action cannot be undone.
      </div>

      <!-- Modal Footer -->
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

    <div class="I_61l">
        @isset($invoiceUrl['message'])
        {{ $invoiceUrl['message'] }}
        <div class="oQEAZ WD4IV">
            <div>
                <a href="#" class="QT4by eVFmT j6D1f janiy adBMs" wire:click="back(3)">
                    <span class="AjwsM">
                        <div class="_1fragem17 _1fragemaf _1fragem38">
                            <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1t _1fragem2a _1fragem0 _1fragem4 _1fragem38">
                                <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wuh a8x1wuf a8x1wum">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 14 14"
                                        focusable="false"
                                        aria-hidden="true"
                                        class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8.4 11.9 3.748 7.248a.35.35 0 0 1 0-.495L8.4 2.1">
                                        </path>
                                    </svg>
                                </span>
                                <span class="_19gi7yt0 _19gi7yte _1fragem1j">Return to payment</span>
                            </div>
                        </div>
                    </span>
                </a>
            </div>
        </div>

        @endisset
        @isset($invoiceUrl['invoice_url'])
        <iframe id="iframe-invoice" class="iframe-invoice" title="Invoice" src="{{ $invoiceUrl['invoice_url'] }}">
        </iframe>
        @endisset
    </div>
    @endif
</div>
