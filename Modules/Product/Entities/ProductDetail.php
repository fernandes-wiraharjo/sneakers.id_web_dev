<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class ProductDetail extends Model
{
    use HasFactory, LadminLogable;

    protected $fillable = [
        'product_id',
        'brand_id',
        'size',
        'qty',
        'weight',
        'base_price',
        'retail_price',
        'after_discount_price',
        'discount_percentage'
    ];

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductDetailFactory::new();
    }

    public function brand(){
        return $this->hasOne(\Modules\Brand\Entities\Brand::class, 'id', 'brand_id');
    }

    public function product(){
        return $this->hasOne(\Modules\Product\Entities\Product::class, 'id', 'product_id',);
    }
}
