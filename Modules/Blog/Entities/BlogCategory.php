<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCategory extends Model
{
    use HasFactory;

    protected $table = 'blog_categories';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'is_show_home',
        'sequence',
        'is_show_single_post',
        'sequence_single_post',
        'is_show_search',
        'sequence_search',
    ];

    protected $casts = [
        'is_show_home' => 'boolean',
        'is_show_single_post' => 'boolean',
        'is_show_search' => 'boolean',
        'sequence' => 'integer',
        'sequence_single_post' => 'integer',
        'sequence_search' => 'integer',
    ];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\BlogCategoryFactory::new();
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}

