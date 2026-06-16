<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CekOngkirService {
    protected string $baseUrl = 'https://rajaongkir.komerce.id/api/v1';

    public function CostCourier($destination, $destinationType = 'subdistrict', $weight = 1000, $courier = 'jne') {
        $origin = config('irfa.rajaongkir.origin_region_id');
        return $this->calculateDomesticCost($origin, $destination, $weight, $courier);
    }

    public function getProvinces(): Collection
    {
        return Cache::remember('rajaongkir_provinces_v3', now()->addDay(), function () {
            return $this->mapLocationItems($this->destinationGet('destination/province'));
        });
    }

    public function getCities($provinceId): Collection
    {
        if (empty($provinceId)) {
            return collect();
        }

        return Cache::remember('rajaongkir_cities_v3_' . $provinceId, now()->addDay(), function () use ($provinceId) {
            return $this->mapLocationItems($this->destinationGet('destination/city/' . $provinceId));
        });
    }

    public function getDistricts($cityId): Collection
    {
        if (empty($cityId)) {
            return collect();
        }

        return Cache::remember('rajaongkir_districts_v3_' . $cityId, now()->addDay(), function () use ($cityId) {
            return $this->mapLocationItems($this->destinationGet('destination/district/' . $cityId));
        });
    }

    public function getSubdistricts($districtId): Collection
    {
        if (empty($districtId)) {
            return collect();
        }

        return Cache::remember('rajaongkir_subdistricts_v3_' . $districtId, now()->addDay(), function () use ($districtId) {
            return $this->mapLocationRows($this->destinationGet('destination/sub-district/' . $districtId));
        });
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
        if ((int) data_get($response, 'meta.code') !== 200) {
            return collect();
        }

        if (is_null($response) || is_null(data_get($response, 'data'))) {
            return collect();
        }

        return collect($response['data']);
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

    protected function destinationGet(string $path): ?array
    {
        $response = Http::withHeaders([
            'key' => config('irfa.rajaongkir.api_key'),
            'accept' => 'application/json',
        ])->get($this->baseUrl . '/' . ltrim($path, '/'));

        if (! $response->successful()) {
            return null;
        }

        return $response->json();
    }

    protected function mapLocationItems(?array $payload): Collection
    {
        return $this->mapLocationRows($payload)
            ->mapWithKeys(function (array $item) {
                return [$item['id'] => $item['name']];
            })
            ->sortBy(fn ($name) => mb_strtolower($name));
    }

    protected function mapLocationRows(?array $payload): Collection
    {
        if (! $payload || (int) data_get($payload, 'meta.code', 0) !== 200) {
            return collect();
        }

        return collect(data_get($payload, 'data', []))
            ->map(function (array $item) {
                $id = $item['id'] ?? $item['destination_id'] ?? null;
                $name = $item['name'] ?? $item['label'] ?? null;

                if ($id === null || $name === null) {
                    return null;
                }

                return [
                    'id' => (string) $id,
                    'name' => $name,
                    'zip_code' => $item['zip_code'] ?? $item['postal_code'] ?? $item['post_code'] ?? null,
                ];
            })
            ->filter()
            ->sortBy(fn (array $item) => mb_strtolower($item['name']))
            ->values();
    }
}
