<?php

namespace Modules\Size\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class SizeMen extends Model
{
    use HasFactory, LadminLogable;

    protected $hidden = ['pivot'];

    protected $table = 'men_sizes';

    protected $fillable = [
        'size_id','US','UK', 'EU', 'CM'
    ];

    protected static function newFactory()
    {
        return \Modules\Size\Database\factories\SizeFactory::new();
    }

    public function charts()
    {
        return $this->hasMany(SizeChart::class,'size_id', 'id');
    }

    public function sizes()
    {
        return $this->belongsTo(Size::class);
    }
}
