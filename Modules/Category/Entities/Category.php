<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class Category extends Model
{
    use HasFactory, LadminLogable;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'category_code',
        'category_title',
        'category_image',
        'category_description',
        'is_active'
    ];

    protected static function newFactory()
    {
        return \Modules\Category\Database\factories\CategoryFactory::new();
    }

    public function products()
    {
        return $this->belongsToMany(\Modules\Product\Entities\Product::class, 'product_tags', 'category_id', 'product_id');
    }
}
