<?php

namespace Modules\Size\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class Size extends Model
{
    use HasFactory, LadminLogable;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'size_code',
        'size_title',
        'size_image',
        'size_description',
        'is_active'
    ];

    protected static function newFactory()
    {
        return \Modules\Size\Database\factories\SizeFactory::new();
    }

    public function products()
    {
        return $this->belongsToMany(\Modules\Product\Entities\Product::class, 'product_sizes', 'size_id', 'product_id');
    }

    public function charts()
    {
        return $this->hasMany(SizeChart::class,'size_id', 'id');
    }

    public function mens()
    {
        return $this->hasOne(SizeMen::class, 'size_id', 'id');
    }

    public function womens()
    {
        return $this->hasOne(SizeWomen::class, 'size_id', 'id');
    }

    public function kids()
    {
        return $this->hasOne(SizeKid::class, 'size_id', 'id');
    }
}
