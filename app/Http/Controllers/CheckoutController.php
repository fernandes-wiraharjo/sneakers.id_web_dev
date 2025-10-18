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

use function App\Services\cancelMidtransTransaction;

class CheckoutController extends BaseController {
    function __construct() {
        Xendit::setApiKey(env('API_KEY'));
    }

    public function successPayments($external_id)
    {
        if(!auth()->check()) {
            return redirect()->route('customer.login')->with('error', 'Session has been expired, please re-login.');
        }

        // update 2025-10-17: callback handled by webhook, this function is purely for view purpose
        $transaction = Transaction::where('token', $external_id)->first();
        $data['transaction'] = $transaction;
        $data['items'] = $transaction->items()->with('detail', 'detail.product')->get();
        $data['shipping'] = $transaction->shipping()->first();
        $data['destination'] = $transaction->destination()->with('region')->first();
        $data['response'] = MidtransTransaction::status($external_id);
        return view('display-store.customer.payment.success', $data);
    }

    public function errorPayments()
    {
        if(!auth()->check()) {
            return redirect()->route('customer.login')->with('error', 'Session has been expired, please re-login.');
        }
        //after few second redirect to cart
        return view('display-store.customer.payment.error');
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
                return response()->json(['message' => 'Transaction not found'], 404);
            }
            if ($transaction->status == 'SUCCESS') {
                return response()->json(['message' => 'Transaction already processed'], 200);
            }

            $transactionDestination = TransactionDestination::where('transaction_id', $transaction->id)->first();
            if (!$transactionDestination) {
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
                    $transaction->update([
                        'type'   => strtoupper($payload['payment_type']),
                        'method' => strtoupper($payload['bank'] ?? ''),
                        'status' => 'SUCCESS',
                        'paid_at' => $payload['settlement_time']
                    ]);
                    
                    Mail::send('email.success-email', [
                        'order_url' => $transaction->invoice_url,
                        'customer_name' => $transactionDestination->first_name . " " . $transactionDestination->last_name,
                        'order_id' => $transaction->token
                    ], function ($message) use ($transactionDestination) {
                        $message->to($transactionDestination->email);
                        $message->subject('SNEAKERS.ID Order Confirmed.');
                    });
                    // TODO: verify cart is cleared after updating cart to use redis / DB instead of session
                    CartService::clear();
                    break;

                case 'expire':
                    $transaction->update([
                        'status' => 'EXPIRED'
                    ]);
                    break;

                case 'cancel':
                    $transaction->update([
                        'status' => 'CANCELLED'
                    ]);
                    break;

                case 'deny':
                    $transaction->update([
                        'status' => 'DENIED'
                    ]);
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
                return redirect()->route('customer.cart')
                    ->with('error', 'Transaction not found.');
            }

            if (in_array($transaction->status, ['CANCELLED', 'SUCCESS'])) {
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
}
