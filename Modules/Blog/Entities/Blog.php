<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class Blog extends Model
{
    use HasFactory, LadminLogable;

    protected $table = 'blog';

    protected $fillable = [
        'slug',
        'title',
        'category_id',
        'content',
        'plain_text',
        'featured_image_url',
        'author',
        'is_carousel',
        'is_active',
        'visitor_count',
    ];

    protected $casts = [
        'is_carousel' => 'boolean',
        'is_active' => 'boolean',
        'visitor_count' => 'integer',
    ];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\BlogFactory::new();
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}

