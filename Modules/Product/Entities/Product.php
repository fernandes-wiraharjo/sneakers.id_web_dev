<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'product_name',
        'product_link',
        'description',
        'is_active'
    ];

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductFactory::new();
    }

    public function detail(){
        return $this->hasOne(ProductDetail::class, 'product_id');
    }
}
