<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ShippingCourier\Entities\ShippingCourierService;

class ShippingCourier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get enabled couriers as colon-separated string for RajaOngkir
     * 
     * @return string
     */
    public static function enabledCouriers(): string
    {
        return static::where('is_active', true)
            ->pluck('code')
            ->implode(':');
    }

    /**
     * Get the services for the courier.
     */
    public function services()
    {
        return $this->hasMany(ShippingCourierService::class);
    }

    /**
     * Get active services for the courier.
     */
    public function activeServices()
    {
        return $this->services()->where('is_active', true);
    }
}
