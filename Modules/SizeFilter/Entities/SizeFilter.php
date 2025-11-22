<?php

namespace Modules\SizeFilter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;
use Modules\Size\Entities\Size;

class SizeFilter extends Model
{
    use HasFactory, LadminLogable;

    protected $fillable = [
        'filter_label',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function newFactory()
    {
        return \Modules\SizeFilter\Database\factories\SizeFilterFactory::new();
    }

    /**
     * Get the sizes associated with this filter
     */
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'size_filter_sizes', 'size_filter_id', 'size_id')
            ->withTimestamps();
    }

    /**
     * Scope for active filters only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered filters
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}

