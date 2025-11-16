<?php

namespace Modules\DiscountVoucher\Repositories;

use Modules\DiscountVoucher\Entities\DiscountVoucher;
use Modules\DiscountVoucher\Entities\DiscountVoucherUsage;
use Illuminate\Support\Facades\DB;

class DiscountVoucherRepository
{
    protected $model;

    public function __construct(DiscountVoucher $model)
    {
        $this->model = $model;
    }

    /**
     * Get all vouchers
     */
    public function getAll()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get voucher by ID
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get voucher by code
     */
    public function getByCode($code)
    {
        return $this->model->where('voucher_code', $code)->first();
    }

    /**
     * Create new voucher
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Generate voucher code if not provided
            if (empty($data['voucher_code'])) {
                $data['voucher_code'] = $this->generateVoucherCode();
            }

            return $this->model->create($data);
        });
    }

    /**
     * Update voucher
     */
    public function update($id, array $data)
    {
        $voucher = $this->getById($id);
        $voucher->update($data);
        return $voucher;
    }

    /**
     * Delete voucher
     */
    public function delete($id)
    {
        $voucher = $this->getById($id);
        return $voucher->delete();
    }

    /**
     * Check if voucher code exists
     */
    public function codeExists($code, $excludeId = null)
    {
        $query = $this->model->where('voucher_code', $code);
        
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    /**
     * Generate unique voucher code
     */
    public function generateVoucherCode($prefix = 'SNKR')
    {
        do {
            $code = $prefix . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
        } while ($this->codeExists($code));

        return $code;
    }

    /**
     * Get active vouchers
     */
    public function getActiveVouchers()
    {
        return $this->model
            ->where('is_active', 1)
            ->where('valid_from', '<=', now())
            ->where('valid_until', '>=', now())
            ->get();
    }

    /**
     * Validate voucher for user
     */
    public function validateVoucherForUser($voucherCode, $userId, $subtotal)
    {
        $voucher = $this->getByCode($voucherCode);

        if (!$voucher) {
            return ['valid' => false, 'message' => 'Voucher not found.'];
        }

        if (!$voucher->isValid()) {
            return ['valid' => false, 'message' => 'Voucher is not valid or has expired.'];
        }

        if ($subtotal < $voucher->min_purchase) {
            return [
                'valid' => false, 
                'message' => 'Minimum purchase of Rp ' . number_format($voucher->min_purchase, 0, ',', '.') . ' required.'
            ];
        }

        if (!$voucher->canBeUsedByUser($userId)) {
            return ['valid' => false, 'message' => 'You have reached the usage limit for this voucher.'];
        }

        $discount = $voucher->calculateDiscount($subtotal);

        return [
            'valid' => true, 
            'voucher' => $voucher,
            'discount' => $discount,
            'message' => 'Voucher applied successfully!'
        ];
    }

    /**
     * Record voucher usage
     */
    public function recordUsage($voucherId, $userId, $transactionId = null)
    {
        return DB::transaction(function () use ($voucherId, $userId, $transactionId) {
            // Create usage record
            DiscountVoucherUsage::create([
                'discount_voucher_id' => $voucherId,
                'user_id' => $userId,
                'transaction_id' => $transactionId
            ]);

            // Increment usage count
            $voucher = $this->getById($voucherId);
            $voucher->increment('usage_count');

            return true;
        });
    }

    /**
     * Get voucher statistics
     */
    public function getStatistics($id)
    {
        $voucher = $this->getById($id);
        
        return [
            'total_usage' => $voucher->usage_count,
            'unique_users' => $voucher->usages()->distinct('user_id')->count('user_id'),
            'remaining_quota' => $voucher->quota_total > 0 ? ($voucher->quota_total - $voucher->usage_count) : 'Unlimited',
            'total_transactions' => $voucher->usages()->whereNotNull('transaction_id')->count()
        ];
    }
}

