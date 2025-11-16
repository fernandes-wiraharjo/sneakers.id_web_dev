<?php

namespace Modules\DiscountVoucher\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;
use App\Models\User;

class DiscountVoucher extends Model
{
    use HasFactory, LadminLogable;

    protected $fillable = [
        'voucher_code',
        'valid_from',
        'valid_until',
        'min_purchase',
        'discount_type',
        'discount_rate',
        'discount_amount',
        'quota_total',
        'quota_per_user',
        'usage_count',
        'is_active'
    ];

    protected $casts = [
        'valid_from' => 'date',
        'valid_until' => 'date',
        'min_purchase' => 'double',
        'discount_rate' => 'decimal:2',
        'discount_amount' => 'double',
        'quota_total' => 'integer',
        'quota_per_user' => 'integer',
        'usage_count' => 'integer',
        'is_active' => 'boolean'
    ];

    protected static function newFactory()
    {
        return \Modules\DiscountVoucher\Database\factories\DiscountVoucherFactory::new();
    }

    /**
     * Check if voucher is valid
     */
    public function isValid()
    {
        $now = now();
        
        // Check if voucher is active
        if (!$this->is_active) {
            return false;
        }

        // Check date validity
        if ($now->lt($this->valid_from) || $now->gt($this->valid_until)) {
            return false;
        }

        // Check quota (0 means unlimited)
        if ($this->quota_total > 0 && $this->usage_count >= $this->quota_total) {
            return false;
        }

        return true;
    }

    /**
     * Check if user can use this voucher
     */
    public function canBeUsedByUser($userId)
    {
        if (!$this->isValid()) {
            return false;
        }

        $userUsageCount = $this->usages()
            ->where('user_id', $userId)
            ->count();

        return $userUsageCount < $this->quota_per_user;
    }

    /**
     * Calculate discount amount for a given subtotal
     */
    public function calculateDiscount($subtotal)
    {
        if ($subtotal < $this->min_purchase) {
            return 0;
        }

        if ($this->discount_type === 'percent') {
            return ($subtotal * $this->discount_rate) / 100;
        }

        return $this->discount_amount;
    }

    /**
     * Get usage records
     */
    public function usages()
    {
        return $this->hasMany(DiscountVoucherUsage::class);
    }

    /**
     * Get users who used this voucher
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'discount_voucher_usage')
            ->withTimestamps();
    }
}

