<?php

namespace Modules\EcommerceLink\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EcommerceLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'ecommerce_code',
        'ecommerce_title',
        'ecommerce_image',
        'ecommerce_description',
        'is_active'
    ];

    protected static function newFactory()
    {
        return \Modules\EcommerceLink\Database\factories\EcommerceLinkFactory::new();
    }
}
