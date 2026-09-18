<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\Transaction\Entities\Transaction;

class ReviewProduct extends Model
{
    use HasFactory;

    protected $table = 'review_product';

    protected $fillable = [
        'user_id',
        'transaction_token',
        'reviewer_name',
        'product_id',
        'product_size',
        'rating',
        'review',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_token', 'token');
    }

    public function getReviewerNameAttribute(): string
    {
        if (! empty($this->attributes['reviewer_name'])) {
            return $this->attributes['reviewer_name'];
        }

        $destination = $this->transaction?->destination;

        if ($destination) {
            $name = trim($destination->first_name . ' ' . $destination->last_name);

            if ($name !== '') {
                return $name;
            }
        }

        return 'Guest';
    }
}

