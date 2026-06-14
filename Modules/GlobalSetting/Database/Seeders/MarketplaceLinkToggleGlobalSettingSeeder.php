<?php

namespace Modules\GlobalSetting\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketplaceLinkToggleGlobalSettingSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $settings = [
            [
                'setting_type' => 'toggle',
                'setting_code' => 'enable_tokopedia_link',
                'setting_value' => '1',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_type' => 'toggle',
                'setting_code' => 'enable_shopee_link',
                'setting_value' => '1',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_type' => 'toggle',
                'setting_code' => 'enable_tiktok_link',
                'setting_value' => '1',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_type' => 'toggle',
                'setting_code' => 'enable_blibli_link',
                'setting_value' => '1',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_type' => 'toggle',
                'setting_code' => 'enable_whatsapp_link',
                'setting_value' => '1',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $inserted = 0;
        $skipped = 0;

        foreach ($settings as $setting) {
            $exists = DB::table('global_settings')
                ->where('setting_code', $setting['setting_code'])
                ->exists();

            if ($exists) {
                $skipped++;
                if ($this->command) {
                    $this->command->warn("Skipped (already exists): {$setting['setting_code']}");
                }

                continue;
            }

            try {
                DB::table('global_settings')->insert($setting);
                $inserted++;
                if ($this->command) {
                    $this->command->info("Inserted: {$setting['setting_code']}");
                }
            } catch (\Exception $e) {
                if ($this->command) {
                    $this->command->error("Failed to insert {$setting['setting_code']}: " . $e->getMessage());
                }
            }
        }

        $message = "Marketplace link toggle seeder completed. Inserted: {$inserted}, Skipped: {$skipped}";
        if ($this->command) {
            $this->command->info($message);
        }
    }
}
