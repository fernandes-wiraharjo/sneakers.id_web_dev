<?php

namespace Modules\Transaction\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;
use Kirschbaum\PowerJoins\PowerJoins;

class TransactionShippings extends Model
{
    use HasFactory;
    use LadminLogable;
    use PowerJoins;

    protected $table = 'transaction_shippings';

    protected $fillable = [
        'transaction_id',
        'shipping_waybill',
        'shipping_method',
        'shipping_cost',
        'shipping_weight',
        'origin_ro_id',
        'destination_ro_id',
        'status',
    ];

    protected static function newFactory()
    {
        return \Modules\Transaction\Database\factories\TransactionShippingsFactory::new();
    }
}
