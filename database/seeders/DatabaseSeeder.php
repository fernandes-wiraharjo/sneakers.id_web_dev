<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Tag\Entities\Tag;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $role = \App\Models\Role::first();
        \App\Models\User::factory(1)->create()
            ->each(function($user) use ($role) {
            $user->roles()->sync([$role->id]);
            });
        $admin = \App\Models\User::create([
            'email' => 'administrator@sneakers.id',
            'name'  => 'Administrator Sneakers',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $admin->roles()->sync([$role->id]);

        $tag = [
            [
                'tag_code' => 'BEST-SELLER',
                'tag_title' => 'BEST SELLER',
                'tag_description' => 'BEST SELLER',
                'is_active' => 1
            ],
            [
                'tag_code' => 'FEATURED',
                'tag_title' => 'FEATURE',
                'tag_description' => 'FEATURED',
                'is_active' => 1
            ],
            [
                'tag_code' => 'NEW-ARRIVAL',
                'tag_title' => 'NEW ARRIVAL',
                'tag_description' => 'NEW ARRIVAL',
                'is_active' => 1
            ],
            [
                'tag_code' => 'NEW-RELEASE',
                'tag_title' => 'NEW RELEASE',
                'tag_description' => 'NEW RELEASE',
                'is_active' => 1
            ],
            [
                'tag_code' => 'DISCOUNT',
                'tag_title' => 'DISCOUNT',
                'tag_description' => 'DISCOUNT',
                'is_active' => 1
            ],
        ];

        $brand = [
            [
                'brand_code' => 'AIR-JORDAN',
                'brand_title' => 'AIR JORDAN',
                'brand_description' => 'AIR JORDAN',
                'is_active' => 1,
                'is_menu' => 1
            ],
            [
                'brand_code' => 'NIKE',
                'brand_title' => 'NIKE',
                'brand_description' => 'NIKE',
                'is_active' => 1,
                'is_menu' => 1
            ],
            [
                'brand_code' => 'UNDER-ARMOUR',
                'brand_title' => 'UNDER ARMOUR',
                'brand_description' => 'UNDER ARMOUR',
                'is_active' => 1,
                'is_menu' => 1
            ],
            [
                'brand_code' => 'ADIDAS',
                'brand_title' => 'ADIDAS',
                'brand_description' => 'ADIDAS',
                'is_active' => 1,
                'is_menu' => 0
            ],
            [
                'brand_code' => 'NEW-BALANCE',
                'brand_title' => 'NEW BALANCE',
                'brand_description' => 'NEW BALANCE',
                'is_active' => 1,
                'is_menu' => 0
            ],
            [
                'brand_code' => 'ASICS',
                'brand_title' => 'ASICS',
                'brand_description' => 'ASICS',
                'is_active' => 1,
                'is_menu' => 0
            ],
        ];


        $category = [
            [
                'category_code' => 'MEN-SHOES',
                'category_title' => 'MEN SHOES',
                'category_description' => 'MEN SHOES',
                'is_active' => 1
            ],
            [
                'category_code' => 'SPORT',
                'category_title' => 'SPORT',
                'category_description' => 'SPORT',
                'is_active' => 1
            ],
            [
                'category_code' => 'CASUAL',
                'category_title' => 'CASUAL',
                'category_description' => 'CASUAL',
                'is_active' => 1
            ],
            [
                'category_code' => 'BASKETBALL-SHOES',
                'category_title' => 'BASKETBALL SHOES',
                'category_description' => 'BASKETBALL SHOES',
                'is_active' => 1
            ],
        ];


        Category::insert($category);
        Brand::insert($brand);
        Tag::insert($tag);

        $this->call([
            SizeSeeder::class,
        ]);
    }
}
