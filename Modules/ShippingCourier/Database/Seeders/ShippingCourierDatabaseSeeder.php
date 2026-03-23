<?php

namespace Modules\ShippingCourier\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\ShippingCourier\Entities\ShippingCourier;

class ShippingCourierDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $couriers = [
            ['code' => 'jne', 'name' => 'JNE', 'is_active' => true],
            ['code' => 'sicepat', 'name' => 'SiCepat', 'is_active' => true],
            ['code' => 'ide', 'name' => 'ID Express', 'is_active' => true],
            ['code' => 'sap', 'name' => 'SAP Express', 'is_active' => false],
            ['code' => 'jnt', 'name' => 'J&T Express', 'is_active' => true],
            ['code' => 'ninja', 'name' => 'Ninja Express', 'is_active' => true],
            ['code' => 'tiki', 'name' => 'TIKI', 'is_active' => true],
            ['code' => 'lion', 'name' => 'Lion Parcel', 'is_active' => true],
            ['code' => 'anteraja', 'name' => 'AnterAja', 'is_active' => true],
            ['code' => 'pos', 'name' => 'POS Indonesia', 'is_active' => true],
            ['code' => 'ncs', 'name' => 'NCS', 'is_active' => false],
            ['code' => 'rex', 'name' => 'REX', 'is_active' => false],
            ['code' => 'rpx', 'name' => 'RPX', 'is_active' => false],
            ['code' => 'sentral', 'name' => 'Sentral Cargo', 'is_active' => false],
            ['code' => 'star', 'name' => 'Star Cargo', 'is_active' => false],
            ['code' => 'wahana', 'name' => 'Wahana', 'is_active' => false],
            ['code' => 'dse', 'name' => 'DSE', 'is_active' => false],
        ];

        foreach ($couriers as $courier) {
            ShippingCourier::create($courier);
        }
    }
}
