<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            //
            'name_en' => $row[0],
            'price'=> $row[1],
            'category_id' => $row[2],
            'brand_id' => $row[3]
        ]);
    }
}
