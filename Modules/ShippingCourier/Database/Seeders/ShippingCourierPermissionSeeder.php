<?php

namespace Modules\ShippingCourier\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class ShippingCourierPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if shipping couriers already exist
        $hasExistingCouriers = DB::table('shipping_couriers')->exists();

        $role = Role::first();
        if ($role) {
            $gates = $role->gates ?? [];
            
            // Add shipping courier permissions
            $newGates = array_merge($gates, [
                'administrator.master-data.shipping-courier.index',
                'administrator.master-data.shipping-courier.create',
                'administrator.master-data.shipping-courier.update',
                'administrator.master-data.shipping-courier.destroy'
            ]);

            $role->update(['gates' => array_unique($newGates)]);
        }

        // Only seed couriers if they don't exist
        if (!$hasExistingCouriers) {
            $this->call(ShippingCourierDatabaseSeeder::class);
        }
    }
}