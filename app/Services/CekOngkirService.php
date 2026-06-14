<?php

namespace App\Services;

use RajaOngkir;
use Illuminate\Support\Facades\Http;

class CekOngkirService {
    public function CostCourier($destination, $destinationType = 'subdistrict', $weight = 1000, $courier = 'jne') {
        $origin = config('irfa.rajaongkir.origin_region_id');
        return $this->calculateDomesticCost($origin, $destination, $weight, $courier);
    }

    public function calculateDomesticCost($origin, $destination, $weight = 1000, $courier = 'jne')
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'key' => config('irfa.rajaongkir.api_key'),
        ])->asForm()->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
            'origin' => $origin,
            'destination' => $destination,
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
            'key' => config('irfa.rajaongkir.api_key'),
        ])->asForm()->post('https://rajaongkir.komerce.id/api/v1/track/waybill', [
            'awb' => $waybill,
            'courier' => $courier,
            'last_phone_number' => $lastFiveDigitPhoneNumber,
        ]);

        return $response->json();
    }

    protected function normalizeCourierServices($services): array
    {
        return collect($services)
            ->map(function ($item) {
                $code = $item['service'] ?? '';

                if ($code === '') {
                    return null;
                }

                return [
                    'code' => $code,
                    'name' => $item['description'] ?? ($item['name'] ?? $code),
                ];
            })
            ->filter()
            ->unique('code')
            ->values()
            ->all();
    }

    /**
     * Fetch courier services from RajaOngkir using two queries:
     * - intracity: origin = destination
     * - intercity: origin -> sample destination
     */
    public function fetchCourierServices(string $courierCode, int $weight = 1000): array
    {
        $origin = config('irfa.rajaongkir.origin_region_id');
        $intercityDestination = config('irfa.rajaongkir.sample_destination_region_id');

        if (empty($origin) || empty(config('irfa.rajaongkir.api_key')) || empty($courierCode)) {
            return [];
        }

        $courier = strtolower($courierCode);
        $services = collect();

        $intracityResponse = $this->calculateDomesticCost($origin, $origin, $weight, $courier);
        $services = $services->merge($this->CostRangeCourier($intracityResponse));

        if (!empty($intercityDestination) && (string) $intercityDestination !== (string) $origin) {
            $intercityResponse = $this->calculateDomesticCost($origin, $intercityDestination, $weight, $courier);
            $services = $services->merge($this->CostRangeCourier($intercityResponse));
        }

        return $this->normalizeCourierServices($services);
    }
}
