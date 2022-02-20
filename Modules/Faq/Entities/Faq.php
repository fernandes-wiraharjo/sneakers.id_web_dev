<?php

namespace Modules\Faq\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class Faq extends Model
{
    use HasFactory, LadminLogable;

    protected $fillable = [
        'faq_title',
        'faq_question',
        'faq_answer'
    ];

    protected static function newFactory()
    {
        return \Modules\Faq\Database\factories\FaqFactory::new();
    }
}
