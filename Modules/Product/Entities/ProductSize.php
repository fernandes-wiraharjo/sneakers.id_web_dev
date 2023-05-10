<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class ProductSize extends Model
{
    use HasFactory, LadminLogable;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductSizeFactory::new();
    }
}
