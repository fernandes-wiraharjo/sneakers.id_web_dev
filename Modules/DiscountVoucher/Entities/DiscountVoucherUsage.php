<?php

namespace Modules\DiscountVoucher\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DiscountVoucherUsage extends Model
{
    protected $table = 'discount_voucher_usage';

    protected $fillable = [
        'discount_voucher_id',
        'user_id',
        'transaction_id'
    ];

    /**
     * Get the voucher
     */
    public function voucher()
    {
        return $this->belongsTo(DiscountVoucher::class, 'discount_voucher_id');
    }

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transaction
     */
    public function transaction()
    {
        return $this->belongsTo(\Modules\Transaction\Entities\Transaction::class);
    }
}

