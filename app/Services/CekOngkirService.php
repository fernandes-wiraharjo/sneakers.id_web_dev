<?php

namespace App\Services;

use RajaOngkir;
use Illuminate\Support\Facades\Http;

class CekOngkirService {
    public function CostCourier($destination = 2, $destinationType = 'subdistrict', $weight = 1000,  $courier = 'jne') {
        $origin = 2088; //  fixed origin
        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Key' => env('RAJAONGKIR_API_KEY'),
        ])->asForm()->post('https://pro.rajaongkir.com/api/cost', [
            'origin' => $origin,
            'originType' => 'subdistrict',
            'destination' => $destination,
            'destinationType' => $destinationType,
            'weight' => $weight,
            'courier' => $courier,
        ]);

        return $response->json();
    }

    public function CostRangeCourier($response = []) {
        return collect($response['rajaongkir']['results']);
    }

}
