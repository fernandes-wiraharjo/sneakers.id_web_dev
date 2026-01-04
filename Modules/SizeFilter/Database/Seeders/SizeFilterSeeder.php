<?php

namespace Modules\SizeFilter\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SizeFilter\Entities\SizeFilter;

class SizeFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data from the size filter table
        // LABEL -> EU SIZES (manually inputted EU sizes stored as JSON array)
        $sizeFilterData = [
            ['label' => '35.5', 'eu_sizes' => ['35.5', '35 1/2']],
            ['label' => '36', 'eu_sizes' => ['36']],
            ['label' => '36.5', 'eu_sizes' => ['36.5', '36 2/3']],
            ['label' => '37.5', 'eu_sizes' => ['37.5', '37 1/3']],
            ['label' => '38', 'eu_sizes' => ['38']],
            ['label' => '38.5', 'eu_sizes' => ['38.5', '38 2/3']],
            ['label' => '39', 'eu_sizes' => ['39', '39 1/3']],
            ['label' => '40', 'eu_sizes' => ['40']],
            ['label' => '40.5', 'eu_sizes' => ['40.5', '40 2/3']],
            ['label' => '41', 'eu_sizes' => ['41', '41 1/3']],
            ['label' => '42', 'eu_sizes' => ['42']],
            ['label' => '42.5', 'eu_sizes' => ['42.5', '42 2/3']],
            ['label' => '43', 'eu_sizes' => ['43', '43 1/3']],
            ['label' => '44', 'eu_sizes' => ['44']],
            ['label' => '44.5', 'eu_sizes' => ['44.5', '44 2/3']],
            ['label' => '45', 'eu_sizes' => ['45', '45 1/3']],
            ['label' => '45.5', 'eu_sizes' => ['45.5']],
            ['label' => '46', 'eu_sizes' => ['46', '46.5']],
            ['label' => '47', 'eu_sizes' => ['47', '47 1/3']],
            ['label' => '47.5', 'eu_sizes' => ['47.5']],
            ['label' => '48', 'eu_sizes' => ['48']],
            ['label' => '48.5', 'eu_sizes' => ['48.5', '48 2/3']],
        ];

        $sortOrder = 0;

        foreach ($sizeFilterData as $data) {
            $sortOrder++;
            
            // Create or update the size filter with EU sizes as JSON array
            SizeFilter::updateOrCreate(
                ['filter_label' => $data['label']],
                [
                    'filter_label' => $data['label'],
                    'eu_sizes' => array_map('trim', $data['eu_sizes']), // Store as array, will be cast to JSON
                    'sort_order' => $sortOrder,
                    'is_active' => true,
                ]
            );
        }
    }
}

