<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Spec;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function productsByCategory(Request $request, $category_id)
    {
        $lang = App::currentLocale();
        $products = Product::select('id','category_id','name_'.$lang.' AS name','image','price')->with('category', 'specs','offers')->where('category_id', $category_id)->get();
        //dd($products);
        $category = Category::select('id','section_id','name_'.$lang.' AS name')->with('section', 'brands')->where('id', $category_id)->first();
        $specs = Spec::with('products')->get();
        $values = DB::table('products_specs')->select('value')->where('spec_id', 1)->distinct('value')->get();
        $newProducts = Product::orderBy('id', 'Desc')->where('status', 1)->limit(5)->get();
        $discountedProducts = DB::table('products_discount')->select('id','name_'.$lang.' AS name','price_after_discount','price','discount')->get();
        return view('website.products.category-products', compact('discountedProducts', 'newProducts', 'values', 'products', 'category', 'specs'));
    }

    public function productDetails($product_id)
    {
        $lang = App::currentLocale();
        $product = Product::query()->where('id', $product_id)
            ->select('id','category_id','image','name_'.$lang.' AS name','price','quantity','desc_'.$lang.' AS desc')
            ->with('specs','user_reviews')->first();
        //dd($product);
        $rating = Review::where('product_id',$product->id)->count();
        $rating_sum = Review::where('product_id',$product->id)->sum('value');

        if($rating > 0){
            $rating_avg = $rating_sum / $rating;
        }else{
            $rating_avg=0;
        }

        $user_rating =  Review::where('product_id',$product->id)->where('user_id',Auth::user()->id)->first();

        $reviews = Review::where('product_id',$product->id)->get();
        //$user = User::with('product_reviews')->find(Auth::user()->id);
        
        //similar books
        $similarProducts = Product::with('category')->where('category_id', $product->category->id)
            ->select('id','category_id','image','name_'.$lang.' AS name','price')
            ->where('id', '!=', $product_id)->limit(3)->get();
        // new products
        $newProducts = Product::orderBy('id', 'Desc')->where('status', 1)->limit(5)->get();
        // discount books
        $discountedProducts = DB::table('products_discount')->select('id','name_'.$lang.' AS name','price_after_discount','price','discount')->get();
        return view('website.products.product-details', compact('discountedProducts', 'newProducts','product', 'similarProducts','rating','rating_avg','user_rating','reviews'));
    }
}
