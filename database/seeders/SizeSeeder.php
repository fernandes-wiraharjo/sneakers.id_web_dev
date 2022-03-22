<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Size\Entities\Size;
use Modules\Size\Entities\SizeChart;
use App\Services\SizeService;
use Modules\Size\Repositories\SizeRepository;

class SizeSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(SizeService $sizeService, SizeRepository $sizeRepository)
    {
        $data = [
            [
                'size_code' => "3.5",
                'size_title' => "3.5",
                'size_description' => "3.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '3.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '3.5Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '3'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '22.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '35.5'
                    ],
                ],
            ],
            [
                'size_code' => "4",
                'size_title' => "4",
                'size_description' => "4",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '4'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '5.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => "4Y"
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '3.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '23'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '36'
                    ],
                ],
            ],
            [
                'size_code' => "4.5",
                'size_title' => "4.5",
                'size_description' => "4.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '4.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '6'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '4.5Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '4'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '23.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '36.5'
                    ],
                ],
            ],
            [
                'size_code' => "5",
                'size_title' => "5",
                'size_description' => "5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '6.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '5Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '4.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '23.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '37.5'
                    ],
                ],
            ],
            [
                'size_code' => "5.5",
                'size_title' => "5.5",
                'size_description' => "5.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '5.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '7'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '5.5Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '24'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '38'
                    ],
                ],
            ],
            [
                'size_code' => "6",
                'size_title' => "6",
                'size_description' => "6",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '6'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '7.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '6Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '5.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '24'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '38.5'
                    ],
                ],
            ],
            [
                'size_code' => "6.5",
                'size_title' => "6.5",
                'size_description' => "6.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '6.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '8'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '6.5Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '6'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '24.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '39'
                    ],
                ],
            ],
            [
                'size_code' => "7",
                'size_title' => "7",
                'size_description' => "7",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '7'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '8.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '7Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '6'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '25'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '40'
                    ],
                ],
            ],
            [
                'size_code' => "7.5",
                'size_title' => "7.5",
                'size_description' => "7.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '7.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '9'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '7.5Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '6.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '25.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '40.5'
                    ],
                ],
            ],
            [
                'size_code' => "8",
                'size_title' => "8",
                'size_description' => "8",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '8'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '9.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '8Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '7'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '26'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '41'
                    ],
                ],
            ],
            [
                'size_code' => "8.5",
                'size_title' => "8.5",
                'size_description' => "8.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '8.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '10'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '8.5Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '7.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '26.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '42'
                    ],
                ],
            ],
            [
                'size_code' => "9",
                'size_title' => "9",
                'size_description' => "9",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '9'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '10.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '9Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '8'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '27'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '42.5'
                    ],
                ],
            ],
            [
                'size_code' => "9.5",
                'size_title' => "9.5",
                'size_description' => "9.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '9.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '11'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '9.5Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '8.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '27.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '43'
                    ],
                ],
            ],
            [
                'size_code' => "10",
                'size_title' => "10",
                'size_description' => "10",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '10'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '11.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '10Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '9'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '28'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '44'
                    ],
                ],
            ],
            [
                'size_code' => "10.5",
                'size_title' => "10.5",
                'size_description' => "10.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '10.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '12'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => '10.5Y'
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '9.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '28.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '44.5'
                    ],
                ],
            ],
            [
                'size_code' => "11",
                'size_title' => "11",
                'size_description' => "11",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '11'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '12.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '10'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '29'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '45'
                    ],
                ],
            ],
            [
                'size_code' => "11.5",
                'size_title' => "11.5",
                'size_description' => "11.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '11.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '13'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '10.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '29.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '45.5'
                    ],
                ],
            ],
            [
                'size_code' => "12",
                'size_title' => "12",
                'size_description' => "12",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '12'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '13.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '11'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '30'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '46'
                    ],
                ],
            ],
            [
                'size_code' => "12.5",
                'size_title' => "12.5",
                'size_description' => "12.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '12.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '14'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '11.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '30.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '47'
                    ],
                ],
            ],
            [
                'size_code' => "13",
                'size_title' => "13",
                'size_description' => "13",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '13'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '14.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '12'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '31'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '47.5'
                    ],
                ],
            ],
            [
                'size_code' => "13.5",
                'size_title' => "13.5",
                'size_description' => "13.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '13.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '15'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '12.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '31.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '48'
                    ],
                ],
            ],
            [
                'size_code' => "14",
                'size_title' => "14",
                'size_description' => "14",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '14'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '15.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '13'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '32'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '48.5'
                    ],
                ],
            ],
            [
                'size_code' => "14.5",
                'size_title' => "14.5",
                'size_description' => "14.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '14.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '16'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '13.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '32.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '49'
                    ],
                ],
            ],
            [
                'size_code' => "15",
                'size_title' => "15",
                'size_description' => "15",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '15'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '16.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '14'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '33'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '49.5'
                    ],
                ],
            ],
            [
                'size_code' => "15.5",
                'size_title' => "15.5",
                'size_description' => "15.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '15.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '17'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '14.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '33.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '50'
                    ],
                ],
            ],
            [
                'size_code' => "16",
                'size_title' => "16",
                'size_description' => "16",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '16'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '17.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '15'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '34'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '50.5'
                    ],
                ],
            ],
            [
                'size_code' => "16.5",
                'size_title' => "16.5",
                'size_description' => "16.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '16.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '18'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '15.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '34.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '51'
                    ],
                ],
            ],
            [
                'size_code' => "17",
                'size_title' => "17",
                'size_description' => "17",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '17'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '18.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '16'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '35'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '51.5'
                    ],
                ],
            ],
            [
                'size_code' => "17.5",
                'size_title' => "17.5",
                'size_description' => "17.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '17.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '19'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '16.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '35.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '52'
                    ],
                ],
            ],
            [
                'size_code' => "18",
                'size_title' => "18",
                'size_description' => "18",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '18'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '19.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '17'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '36'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '52.5'
                    ],
                ],
            ],
            [
                'size_code' => "18.5",
                'size_title' => "18.5",
                'size_description' => "18.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '18.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '20'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '17.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '36.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '53'
                    ],
                ],
            ],
            [
                'size_code' => "19",
                'size_title' => "19",
                'size_description' => "19",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '19'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '20.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '18'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '37'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '53.5'
                    ],
                ],
            ],
            [
                'size_code' => "19.5",
                'size_title' => "19.5",
                'size_description' => "19.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '19.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '21'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '18.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '37.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '54'
                    ],
                ],
            ],
            [
                'size_code' => "20",
                'size_title' => "20",
                'size_description' => "20",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '20'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '21.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '19'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '38'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '54.5'
                    ],
                ],
            ],
            [
                'size_code' => "20.5",
                'size_title' => "20.5",
                'size_description' => "20.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '20.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '22'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '19.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '38.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '55'
                    ],
                ],
            ],
            [
                'size_code' => "21",
                'size_title' => "21",
                'size_description' => "21",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '21'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '22.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '20'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '39'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '55.5'
                    ],
                ],
            ],
            [
                'size_code' => "21.5",
                'size_title' => "21.5",
                'size_description' => "21.5",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '21.5'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '23'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '20.5'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '39.5'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '56'
                    ],
                ],
            ],
            [
                'size_code' => "22",
                'size_title' => "22",
                'size_description' => "22",
                'is_active' => 1,
                'size' => [
                    [
                        'size_name' => "US - Men's",
                        'size_value' => '22'
                    ],
                    [
                        'size_name' => "US - Women's",
                        'size_value' => '23.5'
                    ],
                    [
                        'size_name' => "US - Kid's",
                        'size_value' => null
                    ],
                    [
                        'size_name' => "UK",
                        'size_value' => '21'
                    ],
                    [
                        'size_name' => "CM",
                        'size_value' => '40'
                    ],
                    [
                        'size_name' => "EU",
                        'size_value' => '56.5'
                    ],
                ],
            ],
        ];

        foreach($data as $item)
        {
            print_r($item);
            $data_size = $item['size'];
            unset($item['size']);
            $inserted = Size::create($item);

            foreach($data_size as $item_chart) {
                $sizeRepository->createSizeChart([
                    'size_id' => $inserted->id,
                    'size_name' => $item_chart['size_name'],
                    'size_value' => $item_chart['size_value'] ?? '',
                ]);
            }
        }
    }
}
