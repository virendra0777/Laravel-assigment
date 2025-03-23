<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AirDuctCleaning;

class AirDuctCleaningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            [
                'num_furnace' => '1',
                'square_footage_min' => 0,
                'square_footage_max' => 2000,
                'furnace_loc_sidebyside' => 0,
                'furnace_loc_different' => 0,
                'final_price' => 495,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'num_furnace' => '2',
                'square_footage_min' => 0,
                'square_footage_max' => 2000,
                'furnace_loc_sidebyside' => 0,
                'furnace_loc_different' => 0,
                'final_price' => 595,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'num_furnace' => '3+',
                'square_footage_min' => 0,
                'square_footage_max' => 2000,
                'furnace_loc_sidebyside' => 0,
                'furnace_loc_different' => 0,
                'final_price' => 495,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];
        AirDuctCleaning::insert($list);
    }
}
