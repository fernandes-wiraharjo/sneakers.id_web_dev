<?php

namespace Modules\GlobalSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class GlobalSetting extends Model
{
    use HasFactory, LadminLogable;

    protected $fillable = [
        'setting_type',
        'setting_code',
        'setting_value',
        'is_active'
    ];

    protected static function newFactory()
    {
        return \Modules\Brand\Database\factories\GlobalSettingFactory::new();
    }
}
