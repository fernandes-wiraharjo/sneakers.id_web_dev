<?php

namespace Modules\TopTextCarousel\Entities;

use Illuminate\Database\Eloquent\Model;

class TopTextCarousel extends Model
{
    protected $table = 'top_text_carousel';

    protected $fillable = [
        'text',
        'link',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
