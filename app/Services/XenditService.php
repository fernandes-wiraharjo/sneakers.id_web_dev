<?php

namespace App\Services;

use Xendit\Xendit;

class XenditService {

    function __construct() {
        Xendit::setApiKey(env('API_KEY'));
    }

    public function  getBalance(){
        $getBalance = \Xendit\Balance::getBalance('CASH');

        return $getBalance['balance'] ?? '-';
    }
}
