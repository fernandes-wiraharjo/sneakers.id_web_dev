<?php

namespace App\Services;

use RajaOngkir;
use Illuminate\Support\Facades\Http;

class CekOngkirService {
    public $destinationType = env('RAJAONGKIR_DESTINATION_TYPE');
    public $weight = env('RAJAONGKIR_WEIGHT');
    public $courier = env('RAJAONGKIR_COURIER');

    public function CostCourier($destination, $destinationType, $weight, $courier) {
        $origin = 18080; //  fixed origin
        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'key' => env('RAJAONGKIR_API_KEY'),
        ])->asForm()->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
            'origin' => $origin,
            // 'originType' => 'subdistrict',
            'destination' => $destination,
            // 'destinationType' => $destinationType,
            'weight' => $weight,
            'courier' => $courier,
        ]);

        return $response->json();
    }

    public function CostRangeCourier($response = []) {
        if($response['meta']['code'] != 200){
            return collect();
        }

        if (!is_null($response)){
            if(is_null($response['data'])){
                return collect();
            }

            return collect($response['data']) ?? collect();
        }

        return collect();
    }

    public function CheckWaybill($waybill = null, $courier = 'jne', $lastFiveDigitPhoneNumber) {
        if (!$waybill) {
            return null;
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'key' => env('RAJAONGKIR_API_KEY'),
        ])->asForm()->post('https://rajaongkir.komerce.id/api/v1/track/waybill', [
            'awb' => $waybill,
            'courier' => $courier,
            'last_phone_number' => $lastFiveDigitPhoneNumber,
        ]);

        return $response->json();
    }
}
