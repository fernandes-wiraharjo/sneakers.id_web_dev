<?php

namespace Modules\Faq\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;

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
