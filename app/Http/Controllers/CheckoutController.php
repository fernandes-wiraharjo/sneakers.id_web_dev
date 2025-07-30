<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Xendit\Xendit;
use App\Facades\CheckoutXendit as Service;
use App\Facades\Cart as CartService;
use App\Facades\Transaction as TransactionService;
use Illuminate\Support\Facades\Mail;
use Modules\Transaction\Entities\Transaction;

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
            $transaction = Transaction::where('token', $external_id)->first();
            $data['response'] = \Xendit\Invoice::retrieve($transaction->doc_no);
            $data['transaction'] = $transaction;
            $data['items'] = $transaction->items()->with('detail', 'detail.product')->get();
            $data['shipping'] = $transaction->shipping()->first();
            $data['destination'] = $transaction->destination()->with('region')->first();
            //check status transaction dgn respose jika status != respose status maka update method, type, status

            if($transaction->status != $data['response']['status']){
                $email = $data['response']['customer']['email'];
                $data_email = [
                    'order_url' => $data['response']['success_redirect_url'],
                    'customer_name' => $data['response']['customer']['given_names']." ".$data['response']['customer']['surname'],
                    'order_id' => $data['response']['external_id']
                ];

                $sendMail = Mail::send('email.success-email', $data_email , function($message) use($email){
                    $message->to($email);
                    $message->subject('SNEAKERS.ID Order Confirmed.');
                });


                $updateTransaction = Transaction::where('id', $transaction->id)->first();
                $updateTransaction->update([
                    'type' => $data['response']['payment_channel'],
                    'method' => $data['response']['payment_method'],
                    'status' => $data['response']['status'],
                ]);

                TransactionService::insertHistories([
                    'transaction_id' => $transaction->id,
                    'response_raw' => $data['response'],
                    'response_status' => $data['response']['status'],
                    'response_code' => 200,
                    'response_message' => 'Success Payment from redirect page.',
                ]);
            }
            CartService::clear();

            return view('display-store.customer.payment.success', $data);
        } catch (\Xendit\Exceptions\ApiException $e) {
            $data['message'] =  $e->getMassage();
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
}
