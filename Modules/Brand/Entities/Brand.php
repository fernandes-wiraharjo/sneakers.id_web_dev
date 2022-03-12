<?php

namespace Modules\Brand\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class Brand extends Model
{
    use HasFactory, LadminLogable;

    protected $fillable = [
        'brand_code',
        'brand_title',
        'brand_image',
        'brand_description',
        'is_active',
        'is_menu'
    ];

    protected static function newFactory()
    {
        return \Modules\Brand\Database\factories\BrandFactory::new();
    }

    public function product_details()
    {
        return $this->hasMany(\Modules\Product\Entities\ProductDetail::class, 'brand_id');
    }
}
