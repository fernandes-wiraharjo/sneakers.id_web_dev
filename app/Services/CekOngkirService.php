<?php

namespace App\Services;

use RajaOngkir;
use Illuminate\Support\Facades\Http;

class CekOngkirService {
    public function CostCourier($origin = 151, $destination = 2, $weight = 1000,  $courier = 'jne') {
        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Key' => env('RAJAONGKIR_API_KEY'),
        ])->asForm()->post('https://pro.rajaongkir.com/api/cost', [
            'origin' => $origin,
            'originType' => 'subdistrict',
            'destination' => $destination,
            'destinationType' => 'subdistrict',
            'weight' => $weight,
            'courier' => $courier,
        ]);

        return $response->json();
    }

}
