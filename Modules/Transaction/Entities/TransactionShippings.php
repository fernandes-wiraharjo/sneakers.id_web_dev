<?php

namespace Modules\Transaction\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;

class TransactionShippings extends Model
{
    use HasFactory;
    use PowerJoins;

    protected $table = 'transaction_shippings';

    protected $fillable = [
        'transaction_id',
        'shipping_waybill',
        'shipping_method',
        'shipping_cost',
        'origin_ro_id',
        'destination_ro_id',
        'status',
    ];

    protected static function newFactory()
    {
        return \Modules\Transaction\Database\factories\TransactionShippingsFactory::new();
    }
}
