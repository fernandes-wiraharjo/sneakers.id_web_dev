<?php

namespace App\Services;

use Xendit\Xendit;
use App\Facades\Transaction;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutService {

    function __construct() {
        // Xendit::setApiKey(env('API_KEY'));
        Config::$serverKey    = config('services.midtrans.serverKey');
        Config::$clientKey    = config('services.midtrans.clientKey');
        Config::$isProduction = ! in_array(config('app.env'), ['local', 'uat']);
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    public function createInvoiceMidtrans($args, $transactions)
    {
        $response = [];

        try {
            if (is_string($args)) {
                $args = json_decode($args, true);
            }

            if (!is_array($args)) {
                throw new \Exception("Args is not valid array, got: " . gettype($args));
            }

            if (!isset($args['transaction_details']['order_id'])) {
                throw new \Exception("Missing order_id in args['transaction_details']");
            }

            $snapToken = Snap::getSnapToken($args);

            // $statusResponse = MidtransTransaction::status($args['transaction_details']['order_id']);

            //  dd(
            //     [
            //         "snap" => $snapToken,
            //         "args" => $args['transaction_details']['order_id'],
            //         "stats" => $statusResponse,
            //     ]
            // );

            $transactionData = [
                'args' => $args,
                // 'status_response' => $statusResponse,
                'invoice_url' => "https://app.sandbox.midtrans.com/snap/v2/vtweb/" . $snapToken,
            ];

            Transaction::createTransaction($transactionData, $transactions);

            $response = $transactionData;
        } catch (\Throwable $e) {
            // dd([
            //     "datas" => $args,
            //     "e" => $e,
            //     "transaction" => $transactions,
            // ]);
            
            $response['message'] = $e->getMessage();
        }

        logger($response);
        return $response;
    }


    // public function createInvoiceXendit($args, $transactions) {
    //     $date = new \DateTime();
    //     $redirectUrl = '';
    //     $defParams = [
    //         'external_id' => 'sneakers-id-payments-' . $date->getTimestamp(),
    //         'payer_email' => 'info@sneakers.id',
    //         'description' => 'Sneakers Invoice payment.',
    //         'customer_notification_preference' => [
    //         //     'invoice_created' => [
    //         //         'whatsapp'
    //         //     ],
    //         //     'invoice_reminder' => [
    //         //         'whatsapp'
    //         //     ],
    //         //     'invoice_paid' => [
    //         //         'whatsapp'
    //         //     ],
    //             'invoice_expired' => [
    //                 // 'whatsapp',
    //                 'email'
    //             ]
    //         ],
    //         'failure_redirect_url' => $redirectUrl,
    //         'success_redirect_url' => $redirectUrl
    //     ];

    //     $data = json_decode(json_encode($args), true);
    //     $defParams['failure_redirect_url'] = $data['error_redirect_url'];
    //     $defParams['success_redirect_url'] = route('customer.payment.success', $defParams['external_id']);
    //     $defParams['customer'] = $data['customer'];
    //     $defParams['items'] = $data['items'];
    //     $defParams['fees'] = $data['fees'];

    //     $params = array_merge($defParams, $data);
    //     $response = [];

    //     try {
    //         $response = \Xendit\Invoice::create($params);
    //         //insert into transactions -> $transaction
    //         Transaction::createTransaction($response, $transactions);
    //     } catch (\Throwable $e) {
    //         $response['message'] = $e->getMessage();

    //         // if($response['code' != 200]) {
    //         //     //log error to slack and logger
    //         // }
    //     }

    //     logger($response);
    //     return $response;
    // }

}
