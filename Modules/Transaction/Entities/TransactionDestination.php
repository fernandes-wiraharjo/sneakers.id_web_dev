<?php

namespace Modules\Transaction\Entities;

use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kirschbaum\PowerJoins\PowerJoins;

class TransactionDestination extends Model
{
    use HasFactory;
    use PowerJoins;

    protected $table = 'transaction_destinations';

    protected $fillable = [
        'transaction_id',
        'region_id',
        'email',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'is_user'
    ];

    protected static function newFactory()
    {
        return \Modules\Transaction\Database\factories\TransactionDestinationFactory::new();
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    }

    public function region()
    {
        return $this->hasOne(Region::class, 'region_id', 'region_id');
    }
}
