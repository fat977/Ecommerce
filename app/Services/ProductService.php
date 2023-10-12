<?php
namespace App\Services;

use App\Events\NewProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;

class ProductService{

    public function getProducts(){
        return Product::with('category','brand')->get();
    }

    public function getProductById($id){
        return Product::findOrFail($id);
    }

    public function createProduct($data){
        $product = Product::create($data);
        //Event::dispatch(new NewProduct($product));
        return $product;

    }

    public function updataProduct($id,$data){
        $product = $this->getProductById($id);
        $product->update($data);
        return $product;
    }

    public function deleteProduct($id){
        $product = $this->getProductById($id);
        if($product->image != null){
            Storage::disk('local')->delete('public/products/'.$product->image);
        }
        $product->delete();
    }
}