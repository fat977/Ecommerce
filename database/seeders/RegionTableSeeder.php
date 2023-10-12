<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $regionRecords = [
            [
                'id'=> 1,
                'name_ar'=>'رمسيس',
                'name_en'=>'Ramsees',
                'status'=>1,
                'city_id'=>1
            ],
            [
                'id'=> 2,
                'name_ar'=>'كرموز',
                'name_en'=>'Karmos',
                'status'=>1,
                'city_id'=>2
            ],
            [
                'id'=> 3,
                'name_ar'=>'توريل',
                'name_en'=>'toreal',
                'status'=>1,
                'city_id'=>3
            ],
            [
                'id'=> 4,
                'name_ar'=>'حي شرق',
                'name_en'=>'hay sharq',
                'status'=>1,
                'city_id'=>3
            ],
        ];
        Region::insert($regionRecords);
    }
}
