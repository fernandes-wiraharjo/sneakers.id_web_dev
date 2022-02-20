<?php

namespace Modules\LookBook\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class LookBook extends Model
{
    use HasFactory, LadminLogable;

    protected $fillable = [
        'look_book_title',
        'look_book_description',
        'look_book_content',
        'look_book_order',
        'is_active'
    ];

    protected static function newFactory()
    {
        return \Modules\LookBook\Database\factories\LookBookFactory::new();
    }

    public function images(){
        return $this->hasMany(LookBookImages::class, 'look_book_id');
    }

    public function cards(){
        return $this->hasMany(LookBookCard::class, 'look_book_id');
    }
}
