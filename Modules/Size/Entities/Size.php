<?php

namespace Modules\Size\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;

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
}
