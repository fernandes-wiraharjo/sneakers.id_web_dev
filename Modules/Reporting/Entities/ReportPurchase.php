<?php

namespace Modules\Reporting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportPurchase extends Model
{
    use HasFactory;

    protected $table = 'report_purchase';

    protected $fillable = [
        'order_id',
        'transaction_date',
        'customer_name',
        'transaction_type',
        'location',
        'article_number',
        'product_name',
        'size',
        'quantity',
        'price_ongkir',
        'price_modal',
        'price_jual',
        'price_voucher',
        'price_total_payment',
        'dp_owner',
        'dp_supplier',
        'sisa_owner',
        'sisa_supplier',
        'status_owner',
        'status_supplier',
        'margin_net',
        'modal_net',
        'phone_number',
        'awb_number',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'quantity' => 'integer',
        'price_ongkir' => 'integer',
        'price_modal' => 'integer',
        'price_jual' => 'integer',
        'price_voucher' => 'integer',
        'price_total_payment' => 'integer',
        'dp_owner' => 'integer',
        'dp_supplier' => 'integer',
        'sisa_owner' => 'integer',
        'sisa_supplier' => 'integer',
        'margin_net' => 'integer',
        'modal_net' => 'integer',
    ];
}
