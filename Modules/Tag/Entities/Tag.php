<?php

namespace Modules\Tag\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class Tag extends Model
{
    use HasFactory, LadminLogable;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'tag_code',
        'tag_title',
        'tag_image',
        'tag_description',
        'is_active'
    ];

    protected static function newFactory()
    {
        return \Modules\Tag\Database\factories\TagFactory::new();
    }

    public function products()
    {
        return $this->belongsToMany(\Modules\Product\Entities\Product::class, 'product_tags', 'tag_id', 'product_id')->withTimestamps();
    }
}
