<?php

namespace Modules\SizeFilter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class SizeFilter extends Model
{
    use HasFactory, LadminLogable;

    protected $fillable = [
        'filter_label',
        'eu_sizes',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'eu_sizes' => 'array', // Cast JSON column to array
    ];

    protected static function newFactory()
    {
        return \Modules\SizeFilter\Database\factories\SizeFilterFactory::new();
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

