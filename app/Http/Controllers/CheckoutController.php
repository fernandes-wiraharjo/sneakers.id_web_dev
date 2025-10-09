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
        //clear cart
        //after few second redirect to dashboard
        //check status transksi

        try {
            DB::beginTransaction();
            $transaction = Transaction::where('token', $external_id)->first();
            $data['response'] = MidtransTransaction::status($external_id);
            $data['transaction'] = $transaction;
            $data['items'] = $transaction->items()->with('detail', 'detail.product')->get();
            $data['shipping'] = $transaction->shipping()->first();
            $data['destination'] = $transaction->destination()->with('region')->first();
            //check status transaction dgn respose jika status != respose status maka update method, type, status

            if($transaction->status != data_get($data, 'response.transaction_status')){
                $user = $transaction->user;
                 $data_email = [
                    'order_url' => '',
                    'customer_name' => $user->first_name . " " . $user->last_name,
                    'order_id' => data_get($data, 'response.order_id'),
                ];

                Mail::send('email.success-email', $data_email, function ($message) use ($user) {
                    $message->to($user->email);
                    $message->subject('SNEAKERS.ID Order Confirmed.');
                });


                $updateTransaction = Transaction::where('id', $transaction->id)->first();
                $updateTransaction->update([
                    'type'   => strtoupper(data_get($data, 'response.payment_type')),
                    'method' => strtoupper(data_get($data, 'response.bank')),
                    'status' => strtoupper(data_get($data, 'response.transaction_status')),
                ]);

                TransactionService::insertHistories([
                    'transaction_id' => $transaction->id,
                    'response_raw' => $data['response'],
                    'response_status' => data_get($data, 'response.transaction_status'),
                    'response_code' => 200,
                    'response_message' => 'Success Payment from redirect page.',
                ]);
            }
            DB::commit();
            CartService::clear();
            // CartService::clearOrderId();

            return view('display-store.customer.payment.success', $data);
        } catch (\Xendit\Exceptions\ApiException $e) {
            // TODO: might not needed since transition to midtrans, remove after testing
            DB::rollBack();
            $data['message'] =  $e->getMessage();
            return view('display-store.customer.payment.error', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $data['message'] =  $e->getMessage();
            return view('display-store.customer.payment.error', $data);
        }

    }

    public function errorPayments()
    {
        if(!auth()->check()) {
            return redirect()->route('customer.login')->with('error', 'Session has been expired, please re-login.');
        }
        //after few second redirect to cart
        return view('display-store.customer.payment.error');
    }

     public function handle(Request $request)
    {
        $payload = $request->all();
        Log::info('Midtrans Webhook:', $payload);

        $transactionId = $payload['transaction_id'] ?? null;
        $orderId = $payload['order_id'] ?? null;
        $status = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        if (!$transactionId) {
            return response()->json(['message' => 'Invalid webhook'], 400);
        }

        $transaction = Transaction::where('token', $orderId)->first();
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        switch ($status) {
            case 'settlement':
                $transaction->status = 'SUCCESS';
                $transaction->paid_at = now();
                break;

            case 'expire':
                $transaction->status = 'EXPIRED';
                break;

            case 'cancel':
                $transaction->status = 'CANCELLED';
                break;

            case 'deny':
                $transaction->status = 'DENIED';
                break;

            default:
                $transaction->status = strtoupper($status);
                break;
        }

        $transaction->save();

        return response()->json(['message' => 'Webhook handled'], 200);
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
