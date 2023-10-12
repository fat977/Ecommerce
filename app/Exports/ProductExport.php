<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;

class ProductExport implements FromArray
{
    /**
    * @return \Illuminate\Support\array
    */
    public function array():array
    {
        $list =[];
        $products = Product::all();
        foreach($products as $product){
            $list[] = [
                $product->name_en,$product->price,$product->category_id,$product->brand_id
            ];
        }
        return $list;
    }
}
