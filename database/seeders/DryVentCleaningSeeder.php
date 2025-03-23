<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DryerVentCleaning;

class DryVentCleaningSeeder extends Seeder
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
                'dryer_vent_exit_point' => '0-10 Feet Off the Ground',
                'price' => 95,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'dryer_vent_exit_point' => '10+ Feet Off the Ground',
                'price' => 95,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'dryer_vent_exit_point' => 'Rooftop',
                'price' => 95,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];
        DryerVentCleaning::insert($list);
    }
}
