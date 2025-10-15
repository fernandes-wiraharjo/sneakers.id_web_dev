<?php

namespace Modules\ShippingCourier\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ShippingCourier;

class ShippingCourierService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'shipping_courier_id',
        'code',
        'name',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get the courier that owns the service.
     */
    public function courier()
    {
        return $this->belongsTo(ShippingCourier::class, 'shipping_courier_id');
    }
}
