<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HeaderImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // check table exists
        if (!Schema::hasTable('header_images')) {
            return;
        }

        $baseUrl = config('app.url');
        $defaultCategories = ['all', 'featured', 'new-release', 'best-seller', 'sale', 'MENS', 'WOMENS', 'KIDS', 'PREOWNED'];
        $defaultBrands = ['ADIDAS', 'AIR-JORDAN', 'ANTA', 'LI-NING', 'MOLTEN', 'NIKE', 'PUMA', 'RIGORER', 'UNDER-ARMOUR'];
        $defaultSignaturePlayers = ['AnthonyEdward', 'AustinReaves', 'BreannaStewart', 'DamianLillard', 'DevinBooker', 'DonovanMitchell', 'DwyaneWade',
            'GiannisAntetokounmpo', 'JaMorant', 'JamesHarden', 'JaysonTatum', 'KevinDurant', 'KobeBryant', 'KyrieIrving', 'LameloBall', 'LeBronJames',
            'LukaDoncic', 'RussellWestbrook', 'SabrinaIonescu', 'ScootHenderson', 'StephenCurry', 'TraeYoung', 'ZionWilliamson'];
        
        $existingDatas = DB::table('header_images')->select('menu_name', 'menu_parent_name')->get();
        
        $currentTimestamp = now();
        $insertData = [];
        foreach ($defaultCategories as $category) {
            if ($existingDatas->where('menu_name', $category)->where('menu_parent_name', 'category')->count() > 0) {
                continue;
            }
            $insertData[] = [
                'menu_name' => $category,
                'menu_parent_name' => 'category',
                'image_url' => Storage::disk('public')->url('images/header-image/' . Str::lower($category) . '.webp'),
                'is_active' => 1,
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ];
        }
        foreach ($defaultBrands as $brand) {
            if ($existingDatas->where('menu_name', $brand)->where('menu_parent_name', 'brand')->count() > 0) {
                continue;
            }
            $insertData[] = [
                'menu_name' => $brand,
                'menu_parent_name' => 'brand',
                'image_url' => Storage::disk('public')->url('images/header-image/' . Str::lower($brand) . '.webp'),
                'is_active' => 1,
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ];
        }
        foreach ($defaultSignaturePlayers as $player) {
            if ($existingDatas->where('menu_name', $player)->where('menu_parent_name', 'signatures')->count() > 0) {
                continue;
            }
            $insertData[] = [
                'menu_name' => $player,
                'menu_parent_name' => 'signatures',
                'image_url' => Storage::disk('public')->url('images/header-image/' . Str::lower($player) . '.webp'),
                'is_active' => 1,
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ];
        }

        try {
            DB::beginTransaction();
            DB::table('header_images')->insert($insertData);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('HeaderImageSeeder: ' . $e->getMessage());
            return false;
        }
    }
}
