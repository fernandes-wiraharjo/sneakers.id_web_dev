<?php

namespace Modules\Transaction\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Entities\ProductDetail;
use Kirschbaum\PowerJoins\PowerJoins;

class TransactionItems extends Model
{
    use HasFactory;
    use PowerJoins;

    protected $table = 'transaction_items';

    protected $fillable = [
        'transaction_id',
        'product_detail_id',
        'quantity',
        'weight',
        'price',
    ];

    protected static function newFactory()
    {
        return \Modules\Transaction\Database\factories\TransactionItemsFactory::new();
    }

    public function detail() {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id', 'id');
    }
}
