<?php

namespace App\Facades;

use App\Services\CheckoutService;
use Illuminate\Support\Facades\Facade;

class CheckoutXendit extends Facade {
    protected static function getFacadeAccessor()
    {
        return CheckoutService::class;
    }
}
