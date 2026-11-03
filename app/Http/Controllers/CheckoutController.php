<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Services\MidtransService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Xendit\Xendit;
use App\Facades\CheckoutXendit as Service;
use App\Facades\Cart as CartService;
use App\Facades\Transaction as TransactionService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Transaction as MidtransTransaction;
use Modules\Transaction\Entities\Transaction;
use Modules\Transaction\Entities\TransactionHistories;
use Modules\Transaction\Entities\TransactionDestination;
use Modules\Transaction\Entities\TransactionItems;
use Modules\Product\Entities\ProductDetail;
use Modules\DiscountVoucher\Entities\DiscountVoucher;

use function App\Services\cancelMidtransTransaction;

class CheckoutController extends BaseController {
    function __construct() {
        Xendit::setApiKey(env('API_KEY'));
    }

    public function successPayments(Request $request, $external_id)
    {
        // Midtrans Snap "finish" redirect is used for success AND failure/cancel.
        // Always verify status before showing the order-confirmed page.
        $transaction = Transaction::where('token', $external_id)->first();

        if (!$transaction) {
            return redirect()->route('store')->with('error', 'Transaction not found.');
        }

        $transactionStatus = strtolower((string) $request->query('transaction_status', ''));
        $statusCode = (string) $request->query('status_code', '');

        try {
            $midtransStatus = MidtransTransaction::status($external_id);
            $transactionStatus = strtolower((string) ($midtransStatus->transaction_status ?? $transactionStatus));
            $statusCode = (string) ($midtransStatus->status_code ?? $statusCode);
        } catch (\Throwable $e) {
            Log::warning('Order ID: ' . $external_id . ' Failed to fetch Midtrans status on finish redirect: ' . $e->getMessage());
            $midtransStatus = null;
        }

        $failedStatuses = ['cancel', 'deny', 'expire', 'failure', 'failed'];
        if (in_array($transactionStatus, $failedStatuses, true) || in_array($statusCode, ['202'], true)) {
            return redirect()->route('customer.payment.error');
        }

        // Only treat capture/settlement as paid success. Pending (e.g. VA) may still land here.
        $paidStatuses = ['capture', 'settlement'];
        $localPaid = strtoupper((string) $transaction->status) === 'SUCCESS';
        if (! in_array($transactionStatus, $paidStatuses, true) && ! $localPaid && $transactionStatus !== 'pending') {
            return redirect()->route('customer.payment.error');
        }

        $data['transaction'] = $transaction;
        $data['items'] = $transaction->items()->with('detail', 'detail.product')->get();
        $data['shipping'] = $transaction->shipping()->first();
        $data['destination'] = $transaction->destination()->with('region')->first();
        $data['response'] = $midtransStatus ?: (object) [
            'order_id' => $external_id,
            'payment_type' => $transaction->type ?? '',
            'gross_amount' => $transaction->grand_total ?? 0,
            'transaction_status' => $transactionStatus ?: strtolower((string) $transaction->status),
        ];

        return view('bootstrap.customer.payment.success', $data);
    }

    public function errorPayments()
    {
        // Allow both authenticated and guest users to view payment error
        //after few second redirect to cart
        return view('bootstrap.customer.payment.error');
    }

    public function handleWebhook(Request $request)
    {
        try {
            DB::beginTransaction();
            $payload = $request->all();

            $midtransTransactionId = $payload['transaction_id'] ?? null;
            $orderId = $payload['order_id'] ?? null;
            $status = $payload['transaction_status'] ?? null;

            $transaction = Transaction::where('token', $orderId)->first();
            if (!$transaction) {
                DB::rollBack();
                return response()->json(['message' => 'Transaction not found'], 404);
            }
            if ($transaction->status == 'SUCCESS') {
                DB::rollBack();
                return response()->json(['message' => 'Transaction already processed'], 200);
            }

            $transactionDestination = TransactionDestination::where('transaction_id', $transaction->id)->first();
            if (!$transactionDestination) {
                DB::rollBack();
                return response()->json(['message' => 'Transaction destination not found'], 404);
            }
            
            $history = TransactionService::insertHistories([
                'transaction_id' => $transaction->id,
                'response_raw' => $payload,
                'response_status' => $status,
                'response_code' => $payload['status_code'],
                'response_message' => $payload['status_message'],
            ]);


            switch ($status) {
                case 'settlement':
                case 'capture':
                    $paid_time = $payload['transaction_time'] ?? $payload['settlement_time'];
                    $transaction->update([
                        'type'   => strtoupper($payload['payment_type']),
                        'method' => strtoupper($payload['bank'] ?? ''),
                        'status' => 'SUCCESS',
                        'paid_at' => $paid_time
                    ]);
                    
                    Mail::send('email.success-email', [
                        'order_url' => $transaction->invoice_url,
                        'customer_name' => $transactionDestination->first_name . " " . $transactionDestination->last_name,
                        'order_id' => $transaction->token
                    ], function ($message) use ($transactionDestination) {
                        $message->to($transactionDestination->email);
                        $message->subject('SNEAKERS.ID Order Confirmed.');
                    });
                    
                    // Note: Cart is already cleared when order was created in CheckoutProcess
                    // This webhook just confirms payment status

                    
                    // Stock Update
                    $transactionItems = TransactionItems::where('transaction_id', $transaction->id)->get();
                    foreach ($transactionItems as $item) {
                        $productDetail = ProductDetail::where('id', $item->product_detail_id)->first();
                        $productDetail->update(['qty' => $productDetail->qty - $item->quantity]);
                    }
                    break;

                case 'expire':
                    $transaction->update([
                        'status' => 'EXPIRED'
                    ]);
                    $this->returnVoucherIfAny($transaction->id);
                    break;

                case 'cancel':
                    $transaction->update([
                        'status' => 'CANCELLED'
                    ]);
                    $this->returnVoucherIfAny($transaction->id);
                    break;

                case 'deny':
                    $transaction->update([
                        'status' => 'DENIED'
                    ]);
                    $this->returnVoucherIfAny($transaction->id);
                    break;

                case 'failure':
                    $transaction->update([
                        'status' => 'FAILED'
                    ]);
                    $this->returnVoucherIfAny($transaction->id);
                    break;

                default:
                    $transaction->update([
                        'status' => strtoupper($status)
                    ]);
                    break;
            }

            DB::commit();
            return response()->json(['message' => 'Webhook handled'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Order ID: ' . $orderId . ' Failed to handle webhook: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function cancelTransaction($orderId)
    {
        try {
            DB::beginTransaction();
            $transaction = Transaction::where('token', $orderId)->first();

            if (!$transaction) {
                DB::rollBack();
                return redirect()->route('customer.cart')
                    ->with('error', 'Transaction not found.');
            }

            if (in_array($transaction->status, ['CANCELLED', 'SUCCESS'])) {
                DB::rollBack();
                return redirect()->route('customer.cart')
                    ->with('error', 'Transaction cannot be cancelled.');
            }

            // Only local cancel (not yet recorded in Midtrans)
            $transaction->update([
                'status' => 'CANCELLED',
                'updated_at' => now(),
            ]);

            TransactionHistories::where('transaction_id', $transaction->id)->update([
                'response_status' => 'CANCELLED',
                'updated_at' => now(),
            ]);

            $this->returnVoucherIfAny($transaction->id);

            Cart::clearOrderId();
            DB::commit();
            return redirect()->route('store')
                ->with('success', 'Transaction successfully cancelled.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Order ID: ' . $orderId . ' Failed to cancel transaction: ' . $e->getMessage());
            return redirect()->route('customer.cart')
                ->with('error', 'Failed to cancel transaction.');
        }
    }

    public function returnVoucherIfAny($transactionId)
    {
        $transaction = Transaction::where('id', $transactionId)->first();
        if (!$transaction) {
            return;
        }
        $voucherCode = $transaction->voucher_code;
        $voucher = DiscountVoucher::where('voucher_code', $voucherCode)->first();
        if (!$voucher) {
            return;
        }
        $voucher->update([
            'usage_count' => $voucher->usage_count - 1
        ]);
    }
}
