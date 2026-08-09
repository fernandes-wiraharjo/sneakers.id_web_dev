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
     * Evaluate a voucher against product total and optional shipping cost.
     *
     * @param  float|null  $shippingCost  null = shipping not selected yet
     */
    public function evaluateForCheckout($voucherCode, $email, $productTotal, $shippingCost = null): array
    {
        if (empty($email)) {
            return $this->evaluationFail('Email address is required to apply voucher.');
        }

        $voucher = $this->getByCode($voucherCode);

        if (! $voucher) {
            return $this->evaluationFail('Voucher not found.');
        }

        if (! $voucher->isValid()) {
            return $this->evaluationFail('Voucher is not valid.');
        }

        if (! $voucher->canBeUsedByUser($email)) {
            return $this->evaluationFail('You have reached the usage limit for this voucher.');
        }

        $applyTo = $voucher->apply_to ?? DiscountVoucher::APPLY_TO_CART;
        $min = (float) $voucher->min_purchase;
        $productTotal = (float) $productTotal;
        $shippingKnown = $shippingCost !== null;

        if ($applyTo === DiscountVoucher::APPLY_TO_PRODUCT) {
            if ($productTotal < $min) {
                return $this->evaluationMinFail($voucher);
            }

            return $this->evaluationOk($voucher, $voucher->calculateDiscount($productTotal));
        }

        if ($applyTo === DiscountVoucher::APPLY_TO_SHIPPING) {
            if (! $shippingKnown) {
                return $this->evaluationPending(
                    $voucher,
                    'Voucher applied. Discount will be calculated after shipping is selected.'
                );
            }

            if ((float) $shippingCost < $min) {
                return $this->evaluationMinFail($voucher);
            }

            return $this->evaluationOk($voucher, $voucher->calculateDiscount((float) $shippingCost));
        }

        if (! $shippingKnown) {
            if ($productTotal >= $min) {
                return $this->evaluationOk($voucher, $voucher->calculateDiscount($productTotal));
            }

            return $this->evaluationPending(
                $voucher,
                'Voucher applied. Minimum total including shipping will be checked at checkout.'
            );
        }

        $cartTotal = $productTotal + (float) $shippingCost;
        if ($cartTotal < $min) {
            return $this->evaluationMinFail($voucher);
        }

        return $this->evaluationOk($voucher, $voucher->calculateDiscount($cartTotal));
    }

    /**
     * Validate voucher for user (cart page; shipping usually unknown).
     */
    public function validateVoucherForUser($voucherCode, $subtotal, $email, $shippingCost = null)
    {
        $result = $this->evaluateForCheckout($voucherCode, $email, $subtotal, $shippingCost);

        if ($result['valid'] && ($result['eligible'] || $result['pending'])) {
            return [
                'valid' => true,
                'voucher' => $result['voucher'],
                'discount' => $result['discount'],
                'pending' => $result['pending'],
                'message' => $result['message'],
            ];
        }

        return [
            'valid' => false,
            'message' => $result['message'],
        ];
    }

    protected function evaluationOk(DiscountVoucher $voucher, $discount, string $message = 'Voucher applied successfully!'): array
    {
        return [
            'valid' => true,
            'eligible' => true,
            'pending' => false,
            'discount' => $discount,
            'voucher' => $voucher,
            'message' => $message,
        ];
    }

    protected function evaluationPending(DiscountVoucher $voucher, string $message): array
    {
        return [
            'valid' => true,
            'eligible' => true,
            'pending' => true,
            'discount' => 0,
            'voucher' => $voucher,
            'message' => $message,
        ];
    }

    protected function evaluationMinFail(DiscountVoucher $voucher): array
    {
        return [
            'valid' => true,
            'eligible' => false,
            'pending' => false,
            'discount' => 0,
            'voucher' => $voucher,
            'message' => $voucher->minPurchaseLabel() . ' of Rp ' . number_format($voucher->min_purchase, 0, ',', '.') . ' required.',
        ];
    }

    protected function evaluationFail(string $message): array
    {
        return [
            'valid' => false,
            'eligible' => false,
            'pending' => false,
            'discount' => 0,
            'voucher' => null,
            'message' => $message,
        ];
    }

    /**
     * Record voucher usage
     */
    public function recordUsage($voucherId, $email, $transactionId = null)
    {
        // Email is required in application logic
        if (empty($email)) {
            throw new \InvalidArgumentException('Email address is required to record voucher usage.');
        }

        return DB::transaction(function () use ($voucherId, $email, $transactionId) {
            // Create usage record
            DiscountVoucherUsage::create([
                'discount_voucher_id' => $voucherId,
                'email' => $email,
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
        
        // Count unique emails
        $uniqueEmails = $voucher->usages()->distinct('email')->count('email');
        
        return [
            'total_usage' => $voucher->usage_count,
            'unique_users' => $uniqueEmails,
            'remaining_quota' => $voucher->quota_total > 0 ? ($voucher->quota_total - $voucher->usage_count) : 'Unlimited',
            'total_transactions' => $voucher->usages()->whereNotNull('transaction_id')->count()
        ];
    }
}

