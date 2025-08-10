<?php

namespace App\Facades;

use App\Services\CekOngkirService;
use Illuminate\Support\Facades\Facade;

class CekOngkir extends Facade {
    protected static function getFacadeAccessor()
    {
        return CekOngkirService::class;
    }
}
