<?php

namespace App\Http\Controllers\Dashboard\Product\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\Offer\ProductOfferRequest;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductOfferController extends Controller
{
    public function createOffer($id){
        $product = Product::findOrFail($id);
        $offers = Offer::all();
        return view('dashboard.products.products_offers.create',compact('product','offers'));
    }

    public function storeOffer(ProductOfferRequest $request,$id){
        $data = $request->validated();
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('products_offers')->insert($data);
        if($request->page =='back'){
            return redirect()->back()->with('success','Product Offer is created successfully');
        }else{
            return redirect()->route('admin.products.index');
        }  
    }

    public function editOffer($product_id,$offer_id){
        $data = DB::table('products_offers')->where(['product_id'=>$product_id,'offer_id'=>$offer_id])->first();
        $offers = Offer::all();
        return view('dashboard.products.products_offers.edit',compact('data','offers'));
    }

    public function updateOffer(ProductOfferRequest $request,$product_id,$offer_id){
        $data = $request->validated();
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('products_offers')->where(['product_id'=>$product_id,'offer_id'=>$offer_id])->update($data);
        return redirect()->back()->with('success','Product Offer is updated successfully');
    }

    public function deleteOffer($product_id,$offer_id){
        DB::table('products_offers')->where(['product_id'=>$product_id,'offer_id'=>$offer_id])->delete();;
        return redirect()->back()->with('success','Product Offer is updated successfully');

    }
}
