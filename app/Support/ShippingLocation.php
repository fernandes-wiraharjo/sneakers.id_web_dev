<?php

namespace App\Support;

use App\Models\Region;
use App\Models\UserAddress;
use Modules\Transaction\Entities\TransactionDestination;

class ShippingLocation
{
    public static function resolve($model): array
    {
        if ($model instanceof TransactionDestination || $model instanceof UserAddress) {
            if ($model->region_id) {
                $region = $model->relationLoaded('region')
                    ? $model->region
                    : Region::where('region_id', $model->region_id)->first();

                if ($region) {
                    return [
                        'province' => $region->province,
                        'city' => $region->district,
                        'district' => $region->subdistrict,
                        'subdistrict' => $region->area,
                        'postal_code' => $region->post_code,
                    ];
                }
            }

            return [
                'province' => $model->province,
                'city' => $model->city,
                'district' => $model->district,
                'subdistrict' => $model->subdistrict,
                'postal_code' => $model->postal_code,
            ];
        }

        if ($model instanceof Region) {
            return [
                'province' => $model->province,
                'city' => $model->district,
                'district' => $model->subdistrict,
                'subdistrict' => $model->area,
                'postal_code' => $model->post_code,
            ];
        }

        return [
            'province' => null,
            'city' => null,
            'district' => null,
            'subdistrict' => null,
            'postal_code' => null,
        ];
    }

    public static function formatLines($model, string $separator = '<br>'): string
    {
        $location = self::resolve($model);

        return collect([
            $location['subdistrict'],
            $location['district'],
            $location['city'],
            trim(($location['province'] ?? '') . ' ' . ($location['postal_code'] ?? '')),
        ])->filter()->implode($separator);
    }
}
