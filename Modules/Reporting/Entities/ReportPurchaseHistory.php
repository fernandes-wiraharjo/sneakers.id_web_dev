<?php

namespace Modules\Reporting\Entities;

use Illuminate\Database\Eloquent\Model;

class ReportPurchaseHistory extends Model
{
    protected $table = 'report_purchase_history';

    protected $fillable = [
        'report_purchase_id',
        'data_before',
        'data_after',
        'updated_by',
    ];

    protected $casts = [
        'data_before' => 'array',
        'data_after' => 'array',
    ];

    public function reportPurchase()
    {
        return $this->belongsTo(ReportPurchase::class);
    }
}
