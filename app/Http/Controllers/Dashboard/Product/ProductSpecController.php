<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ProductSpec\ProductSpecRequest;
use App\Models\Product;
use App\Models\Spec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductSpecController extends Controller
{
    //
    public function createSpec($id){
        $product = Product::findOrFail($id);
        $specs = Spec::all();
        return view('dashboard.products.products_specs.create',compact('product','specs'));
    }

    public function storeSpec(ProductSpecRequest $request,$id){
        $data = $request->validated();
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('products_specs')->insert($data);
        //$product->specs()->attach($request->specs,['value'=>$request->value,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
        if($request->page =='back'){
            return redirect()->back()->with('success','Product Spec is created successfully');
        }else{
            return redirect()->route('admin.products.index');
        }  
    }

    public function editSpec($product_id,$spec_id){
        $data = DB::table('products_specs')->where(['product_id'=>$product_id,'spec_id'=>$spec_id])->first();
        return view('dashboard.products.products_specs.edit',compact('data'));
    }

    public function updateSpec(ProductSpecRequest $request,$product_id,$spec_id){
        $data = $request->validated();
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('products_specs')->where(['product_id'=>$product_id,'spec_id'=>$spec_id])->update($data);
        return redirect()->back()->with('success','Product Spec is updated successfully');
    }

    public function deleteSpec($product_id,$spec_id){
        $data = DB::table('products_specs')->where(['product_id'=>$product_id,'spec_id'=>$spec_id])->delete();;
        return redirect()->back()->with('success','Product Spec is updated successfully');

    }
}
