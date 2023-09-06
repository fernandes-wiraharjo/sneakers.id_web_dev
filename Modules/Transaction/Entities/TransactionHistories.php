<?php

namespace Modules\Transaction\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;
use Kirschbaum\PowerJoins\PowerJoins;

class TransactionHistories extends Model
{
    use HasFactory;
    use LadminLogable;
    use PowerJoins;

    protected $table = 'transaction_histories';

    protected $fillable = [
        'transaction_id',
        'transaction_history_id',
        'response_raw',
        'response_status',
        'response_code',
        'response_message',
        'created_by',
        'updated_by',
    ];

    protected static function newFactory()
    {
        return \Modules\Transaction\Database\factories\TransactionHistoriesFactory::new();
    }
}
