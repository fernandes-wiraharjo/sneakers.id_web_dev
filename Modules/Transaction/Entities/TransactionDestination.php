<?php

namespace Modules\Transaction\Entities;

use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Hexters\Ladmin\LadminLogable;
use Kirschbaum\PowerJoins\PowerJoins;

class TransactionDestination extends Model
{
    use HasFactory;
    use LadminLogable;
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
        'is_user',
        'user_id',
    ];

    protected static function newFactory()
    {
        return \Modules\Transaction\Database\factories\TransactionDestinationFactory::new();
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function region()
    {
        return $this->hasOne(Region::class, 'region_id', 'region_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
