<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey    = config('services.midtrans.serverKey');
        Config::$clientKey    = config('services.midtrans.clientKey');
        Config::$isProduction = ! in_array(config('app.env'), ['local', 'uat']);
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    // Create Snap transaction
    public function createTransaction(array $params)
    {
        return Snap::createTransaction($params);
    }

    // Check transaction status
    public function getStatus(string $orderId)
    {
        return Transaction::status($orderId);
    }
}
