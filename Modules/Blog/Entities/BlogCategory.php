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
    ];

    protected $casts = [
        'is_show_home' => 'boolean',
        'sequence' => 'integer',
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

