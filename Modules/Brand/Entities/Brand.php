<?php

namespace Modules\Brand\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_code',
        'brand_title',
        'brand_image',
        'brand_description',
        'is_active'
    ];

    protected static function newFactory()
    {
        return \Modules\Brand\Database\factories\BrandFactory::new();
    }
}
