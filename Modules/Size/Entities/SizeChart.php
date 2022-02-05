<?php

namespace Modules\Size\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SizeChart extends Model
{
    use HasFactory;

    protected $fillable = [
        'size_id',
        'size_name',
        'size_value'
    ];

    protected static function newFactory()
    {
        return \Modules\Size\Database\factories\SizeChartFactory::new();
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
