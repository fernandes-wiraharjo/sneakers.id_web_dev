<?php

namespace Modules\LookBook\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LookBookCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'look_book_id',
        'image_url',
        'look_book_card_title',
        'look_book_card_url',
        'look_book_card_description',
        'is_active'
    ];

    protected static function newFactory()
    {
        return \Modules\LookBook\Database\factories\LookBookCardFactory::new();
    }

    public function lookbook(){
        return $this->belongsTo(LookBook::class, 'id');
    }
}
