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
        if($response['rajaongkir']['status']['code'] == 400){
            return collect();
        }
        if (!is_null($response)){
            if(is_null($response['rajaongkir']['results'])){
                return collect();
            }
            return collect($response['rajaongkir']['results']) ?? collect();
        }

        return collect();
    }

    public function CheckWaybill($waybill = null, $courier = 'jne') {
        if (!$waybill) {
            return null;
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Key' => env('RAJAONGKIR_API_KEY'),
        ])->asForm()->post('https://pro.rajaongkir.com/api/waybill', [
            'waybill' => $waybill,
            'courier' => $courier,
        ]);

        return $response->json();
    }
}
