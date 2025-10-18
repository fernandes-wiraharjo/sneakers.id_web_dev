<?php

namespace Modules\Transaction\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Refund extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'refunds';

    protected $fillable = [
        'transaction_id',
        'bank_name',
        'account_number',
        'account_holder_name',
        'amount',
        'proof_image',
        'reason',
        'processed_by',
        'processed_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'processed_at' => 'datetime'
    ];
    
    /**
     * Get the transaction that owns the refund.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    /**
     * Get the user who processed the refund.
     */
    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Transaction\Database\factories\RefundFactory::new();
    }
}
