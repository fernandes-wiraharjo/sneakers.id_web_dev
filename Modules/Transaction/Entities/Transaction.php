<?php

namespace Modules\Transaction\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;

class Transaction extends Model
{
    use HasFactory;
    use PowerJoins;

    protected $table = 'transactions';

    protected $fillable = [
        'uuid',
        'doc_no',
        'token',
        'date',
        'gateway',
        'type',
        'method',
        'invoice_url',
        'total_quantity',
        'total_weight',
        'sub_total',
        'grand_total',
        'description',
        'status'
    ];

    protected static function newFactory()
    {
        return \Modules\Transaction\Database\factories\TransactionFactory::new();
    }

    public function items()
    {
        return $this->hasMany(TransactionItems::class, 'transaction_id', 'id');
    }

    public function shipping()
    {
        return $this->hasOne(TransactionShippings::class, 'transaction_id', 'id');
    }

    public function destination()
    {
        return $this->hasOne(TransactionDestination::class, 'transaction_id', 'id');
    }

    public function histories()
    {
        return $this->hasMany(TransactionHistories::class, 'transaction_id', 'id');
    }

    public function getUserData()
    {
         // Ensure the 'destination' relationship is loaded using 'with'
        // Eager load the 'destination' relationship if it's not already loaded
        if (!$this->relationLoaded('destination')) {
            $this->load('destination');
        }

        if ($this->destination) {
            return $this->destination->user();
        }

        return $this->destination();
    }
}