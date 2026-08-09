<?php

namespace Modules\DiscountVoucher\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;

class DiscountVoucher extends Model
{
    use HasFactory, LadminLogable;

    public const APPLY_TO_SHIPPING = 'shipping';
    public const APPLY_TO_PRODUCT = 'product';
    public const APPLY_TO_CART = 'cart';

    protected $fillable = [
        'voucher_code',
        'valid_from',
        'valid_until',
        'min_purchase',
        'apply_to',
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

    public static function applyToOptions(): array
    {
        return [
            self::APPLY_TO_SHIPPING => 'Shipping cost only',
            self::APPLY_TO_PRODUCT => 'Total product only',
            self::APPLY_TO_CART => 'Entire cart',
        ];
    }

    public function applyToLabel(): string
    {
        return self::applyToOptions()[$this->apply_to ?? self::APPLY_TO_CART] ?? 'Entire cart';
    }

    public function minPurchaseLabel(): string
    {
        return match ($this->apply_to ?? self::APPLY_TO_CART) {
            self::APPLY_TO_SHIPPING => 'Minimum shipping cost',
            self::APPLY_TO_PRODUCT => 'Minimum total product price',
            default => 'Minimum total purchase (incl. shipping)',
        };
    }

    public function appliesToShipping(): bool
    {
        return ($this->apply_to ?? self::APPLY_TO_CART) === self::APPLY_TO_SHIPPING;
    }

    public function appliesToProduct(): bool
    {
        return ($this->apply_to ?? self::APPLY_TO_CART) === self::APPLY_TO_PRODUCT;
    }

    public function appliesToCart(): bool
    {
        return ($this->apply_to ?? self::APPLY_TO_CART) === self::APPLY_TO_CART;
    }

    /**
     * Base amount used to calculate this voucher's discount.
     */
    public function discountBaseAmount($productTotal, $shippingCost = 0)
    {
        return match ($this->apply_to ?? self::APPLY_TO_CART) {
            self::APPLY_TO_SHIPPING => (float) $shippingCost,
            self::APPLY_TO_PRODUCT => (float) $productTotal,
            default => (float) $productTotal + (float) $shippingCost,
        };
    }

    /**
     * Amount used to check the minimum threshold.
     */
    public function minimumBaseAmount($productTotal, $shippingCost = 0)
    {
        return $this->discountBaseAmount($productTotal, $shippingCost);
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
    public function canBeUsedByUser($email)
    {
        if (!$this->isValid()) {
            return false;
        }

        // Email is required in application logic
        if (empty($email)) {
            return false;
        }

        $userUsageCount = $this->usages()
            ->where('email', $email)
            ->count();

        return $userUsageCount < $this->quota_per_user;
    }

    /**
     * Calculate discount amount for a given base amount.
     * $baseAmount should already match apply_to (shipping / product / cart).
     */
    public function calculateDiscount($baseAmount, $shippingCost = null)
    {
        $amount = $shippingCost === null
            ? (float) $baseAmount
            : $this->discountBaseAmount($baseAmount, $shippingCost);

        if ($amount < (float) $this->min_purchase) {
            return 0;
        }

        if ($this->discount_type === 'percent') {
            $discount = ($amount * $this->discount_rate) / 100;
            
            // Apply max discount cap if set
            if ($this->discount_amount && $this->discount_amount > 0 && $discount > $this->discount_amount) {
                $discount = $this->discount_amount;
            }

            return min($discount, $amount);
        }

        return min((float) $this->discount_amount, $amount);
    }

    /**
     * Get usage records
     */
    public function usages()
    {
        return $this->hasMany(DiscountVoucherUsage::class);
    }

}

