<?php

use Modules\Transaction\Entities\TransactionDestination;

if (! function_exists('userHasOngoingPayment')) {
    function userHasOngoingPayment() {
        if (!auth()->check()) {
            return null;
        }

       return TransactionDestination::query()
        ->where('transaction_destinations.user_id', auth()->id())
        ->join('transaction_histories', 'transaction_histories.transaction_id', '=', 'transaction_destinations.transaction_id')
        ->join('transactions', 'transactions.id', '=', 'transaction_destinations.transaction_id')
        ->where('transaction_histories.response_status', 'CREATED') // or CREATED if that's the ongoing state
        ->select(
            'transaction_destinations.*',
            'transaction_histories.response_status',
            'transactions.invoice_url',
            'transactions.grand_total'
        )
        ->latest('transaction_destinations.created_at')
        ->first();
    }
}
