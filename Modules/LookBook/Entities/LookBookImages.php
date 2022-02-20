<?php

namespace Modules\LookBook\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class LookBookImages extends Model
{
    use HasFactory, LadminLogable;

    protected $fillable = [
        'look_book_id',
        'image_url'
    ];

    protected static function newFactory()
    {
        return \Modules\LookBook\Database\factories\LookBookImagesFactory::new();
    }

    public function lookbook(){
        return $this->belongsTo(LookBook::class, 'id');
    }
}
