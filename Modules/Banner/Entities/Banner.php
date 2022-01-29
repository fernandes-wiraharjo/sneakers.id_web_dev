<?php

namespace Modules\Banner\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_image',
        'order',
        'banner_description',
        'banner_url',
        'is_headline',
        'is_active'
    ];

    protected static function newFactory()
    {
        return \Modules\Banner\Database\factories\BannerFactory::new();
    }
}
