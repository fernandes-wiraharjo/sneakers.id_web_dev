<?php

namespace App\Facades;

use App\Services\XenditService as Xs;
use Illuminate\Support\Facades\Facade;

class XenditServices extends Facade {
    protected static function getFacadeAccessor()
    {
        return Xs::class;
    }
}
