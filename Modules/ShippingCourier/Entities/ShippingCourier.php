<?php

namespace Modules\ShippingCourier\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingCourier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
    
    protected static function newFactory()
    {
        return \Modules\ShippingCourier\Database\factories\ShippingCourierFactory::new();
    }
}
