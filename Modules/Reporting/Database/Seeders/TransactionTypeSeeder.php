<?php

namespace Modules\Reporting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Reporting\Entities\TransactionType;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seeds default transaction type WEB if none exist.
     *
     * @return void
     */
    public function run()
    {
        if (TransactionType::count() > 0) {
            return;
        }
        TransactionType::create([
            'code' => 'WEB',
            'name' => 'Web',
            'is_active' => true,
        ]);
    }
}
