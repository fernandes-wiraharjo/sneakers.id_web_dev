<?php

namespace Modules\SignaturePlayer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SignaturePlayer extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'signature_code',
        'signature_title',
        'signature_player_name',
        'signature_image',
        'signature_description',
        'is_active'
    ];

    protected static function newFactory()
    {
        return \Modules\SignaturePlayer\Database\factories\SignaturePlayerFactory::new();
    }

    public function products()
    {
        return $this->belongsToMany(\Modules\Product\Entities\Product::class, 'product_tags', 'signature_player_id', 'product_id');
    }
}
