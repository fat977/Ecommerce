<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $cityRecords = [
            [
                'id'=> 1,
                'name_ar'=>'القاهرة',
                'name_en'=>'Cairo',
                'status'=>1,
            ],
            [
                'id'=> 2,
                'name_ar'=>'الاسكندرية',
                'name_en'=>'Alex',
                'status'=>1,
            ],
            [
                'id'=> 3,
                'name_ar'=>'المنصورة',
                'name_en'=>'Mansoura',
                'status'=>1,
            ],
        ];
        City::insert($cityRecords);
    }
}
