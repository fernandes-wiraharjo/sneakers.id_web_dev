<?php

namespace Modules\SizeFilter\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SizeFilter\Entities\SizeFilter;
use Modules\Size\Entities\Size;

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
        // LABEL -> KEYWORD (EU sizes to match)
        $sizeFilterData = [
            ['label' => '35.5', 'keywords' => ['35.5', '35 1/2']],
            ['label' => '36', 'keywords' => ['36']],
            ['label' => '36.5', 'keywords' => ['36.5', '36 2/3']],
            ['label' => '37.5', 'keywords' => ['37.5', '37 1/3']],
            ['label' => '38', 'keywords' => ['38']],
            ['label' => '38.5', 'keywords' => ['38.5', '38 2/3']],
            ['label' => '39', 'keywords' => ['39']],
            ['label' => '40', 'keywords' => ['40']],
            ['label' => '40.5', 'keywords' => ['40.5', '40 2/3']],
            ['label' => '41', 'keywords' => ['41']],
            ['label' => '42', 'keywords' => ['42']],
            ['label' => '42.5', 'keywords' => ['42.5', '42 2/3']],
            ['label' => '43', 'keywords' => ['43']],
            ['label' => '44', 'keywords' => ['44']],
            ['label' => '44.5', 'keywords' => ['44.5', '44 2/3']],
            ['label' => '45', 'keywords' => ['45']],
            ['label' => '45.5', 'keywords' => ['45.5']],
            ['label' => '46', 'keywords' => ['46', '46.5']],
            ['label' => '47', 'keywords' => ['47']],
            ['label' => '47.5', 'keywords' => ['47.5']],
            ['label' => '48', 'keywords' => ['48']],
            ['label' => '48.5', 'keywords' => ['48.5', '48 2/3']],
        ];

        $sortOrder = 0;

        foreach ($sizeFilterData as $data) {
            $sortOrder++;
            
            // Create or update the size filter
            $sizeFilter = SizeFilter::updateOrCreate(
                ['filter_label' => $data['label']],
                [
                    'filter_label' => $data['label'],
                    'sort_order' => $sortOrder,
                    'is_active' => true,
                ]
            );

            // Find sizes that match any of the EU keywords
            $matchingSizeIds = [];
            
            foreach ($data['keywords'] as $keyword) {
                // Find sizes with matching EU size_value (match as string)
                $sizes = Size::whereHas('charts', function ($query) use ($keyword) {
                    $query->where('size_name', 'EU')
                          ->where('size_value', $keyword);
                })->pluck('id')->toArray();
                
                $matchingSizeIds = array_merge($matchingSizeIds, $sizes);
            }
            
            // Remove duplicates
            $matchingSizeIds = array_unique($matchingSizeIds);
            
            // Attach sizes to the filter
            if (!empty($matchingSizeIds)) {
                $sizeFilter->sizes()->sync($matchingSizeIds);
            }
        }
    }
}

