<?php

namespace Modules\ExternalReview\Entities;

use App\Models\ReviewProduct;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;
use Modules\Product\Entities\Product;

class ExternalReviewLink extends Model
{
    use HasFactory, LadminLogable;

    protected $fillable = [
        'token',
        'product_id',
        'product_size',
        'buyer_name',
        'review_product_id',
        'used_at',
        'created_by',
    ];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function reviewProduct()
    {
        return $this->belongsTo(ReviewProduct::class, 'review_product_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isUsed(): bool
    {
        return $this->used_at !== null;
    }

    public function getReviewUrlAttribute(): string
    {
        return route('external-review.show', $this->token);
    }
}
