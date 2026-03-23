<?php

namespace Modules\HeaderImage\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class HeaderImage extends Model
{
    use HasFactory, LadminLogable;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'menu_name',
        'menu_parent_name',
        'image_url',
        'is_active'
    ];

    protected static function newFactory()
    {
        return \Modules\HeaderImage\Database\factories\HeaderImageFactory::new();
    }
}
