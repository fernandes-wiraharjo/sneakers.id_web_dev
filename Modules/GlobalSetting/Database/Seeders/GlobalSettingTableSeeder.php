<?php

namespace Modules\GlobalSetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GlobalSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $settings = [
            [
                'id' => 1,
                'setting_type' => 'image',
                'setting_code' => 'favicon',
                'setting_value' => asset('stores-info/logos.png'),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'setting_type' => 'image',
                'setting_code' => 'logo_navbar',
                'setting_value' => asset('stores-info/logo-black-new.png'),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'setting_type' => 'image',
                'setting_code' => 'logo_footer',
                'setting_value' => asset('stores-info/logo-white-new.png'),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'setting_type' => 'image',
                'setting_code' => 'auth_page_side_image_website',
                'setting_value' => asset('stores-info/login-img-md.webp'),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'setting_type' => 'image',
                'setting_code' => 'auth_page_side_image_mobile',
                'setting_value' => asset('stores-info/login-img.webp'),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        $inserted = 0;
        $skipped = 0;

        foreach ($settings as $setting) {
            $exists = DB::table('global_settings')
                ->where('id', $setting['id'])
                ->orWhere('setting_code', $setting['setting_code'])
                ->exists();

            if (!$exists) {
                try {
                    DB::table('global_settings')->insert($setting);
                    $inserted++;
                    if ($this->command) {
                        $this->command->info("Inserted: {$setting['setting_code']}");
                    } else {
                        echo "Inserted: {$setting['setting_code']}\n";
                    }
                } catch (\Exception $e) {
                    if ($this->command) {
                        $this->command->error("Failed to insert {$setting['setting_code']}: " . $e->getMessage());
                    } else {
                        echo "Failed to insert {$setting['setting_code']}: " . $e->getMessage() . "\n";
                    }
                }
            } else {
                $skipped++;
                if ($this->command) {
                    $this->command->warn("Skipped (already exists): {$setting['setting_code']}");
                } else {
                    echo "Skipped (already exists): {$setting['setting_code']}\n";
                }
            }
        }

        $message = "Seeder completed. Inserted: {$inserted}, Skipped: {$skipped}";
        if ($this->command) {
            $this->command->info($message);
        } else {
            echo $message . "\n";
        }
    }
}
