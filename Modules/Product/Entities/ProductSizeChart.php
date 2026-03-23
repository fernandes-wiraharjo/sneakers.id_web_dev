<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSizeChart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size_chart_image_url'
    ];

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductSizeChart::new();
    }
}
