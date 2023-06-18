<?php

namespace App\Services;

use Xendit\Xendit;
use App\Facades\Transaction;

class CheckoutService {

    function __construct() {
        Xendit::setApiKey(env('API_KEY'));
    }

    public function createInvoice($args, $transactions) {
        $date = new \DateTime();
        $redirectUrl = '';
        $defParams = [
            'external_id' => 'sneakers-id-payments-' . $date->getTimestamp(),
            'payer_email' => 'info@sneakers.id',
            'description' => 'Sneakers Invoice payment.',
            // 'customer_notification_preference' => [
            //     'invoice_created' => [
            //         'whatsapp'
            //     ],
            //     'invoice_reminder' => [
            //         'whatsapp'
            //     ],
            //     'invoice_paid' => [
            //         'whatsapp'
            //     ],
            //     'invoice_expired' => [
            //         'whatsapp'
            //     ]
            // ],
            'failure_redirect_url' => $redirectUrl,
            'success_redirect_url' => $redirectUrl
        ];

        $data = json_decode(json_encode($args), true);
        $defParams['failure_redirect_url'] = $data['error_redirect_url'];
        $defParams['success_redirect_url'] = route('customer.payment.success', $defParams['external_id']);
        $defParams['customer'] = $data['customer'];
        $defParams['items'] = $data['items'];
        $defParams['fees'] = $data['fees'];

        $params = array_merge($defParams, $data);
        $response = [];

        try {
            $response = \Xendit\Invoice::create($params);

            //insert into transactions -> $transaction
            Transaction::createTransaction($response, $transactions);
        } catch (\Throwable $e) {
            $response['message'] = $e->getMessage();

            // if($response['code' != 200]) {
            //     //log error to slack and logger
            // }
        }

        logger($response);
        return $response;
    }
}
