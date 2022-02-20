<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class Product extends Model
{
    use HasFactory, LadminLogable;

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

    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function tags(){
        return $this->belongsToMany(\Modules\Tag\Entities\Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function sizes(){
        return $this->belongsToMany(\Modules\Size\Entities\Size::class, 'product_sizes', 'product_id', 'size_id');
    }

    public function categories(){
        return $this->belongsToMany(\Modules\Category\Entities\Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function signatures(){
        return $this->belongsToMany(\Modules\SignaturePLayer\Entities\SignaturePLayer::class, 'product_signature', 'product_id', 'signature_player_id');
    }
}
