<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(Auth::check()){
            $user_id =Auth::user()->id;
            $carts = Cart::query()->where('user_id',$user_id)->get();
            $user = User::with('products')->find($user_id);
            //dd($user);
            $discountedProducts = DB::table('products_discount')->get();
            return view('website.cart.index',compact('carts','user','discountedProducts'));  
        }else{
            return view('auth.register');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request,$id)
    {
        //
        
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if(Auth::check()){
            $data = $request->except('_token');
            $product_id = $data['product_id'];
            $user_id =Auth::user()->id;
        
            // check quantity
            $productQuantity = Product::query()->where('id',$product_id)->select('quantity')->first();
            if( $productQuantity->quantity < $request->quantity){
                return redirect()->back()->with(['error'=>'This quantity not available']);
            }
            //check if product is exist or not
            $existProduct = Cart::query()->where(['user_id'=> $user_id , 'product_id'=>$product_id])->exists();
            if($existProduct){
                return redirect()->back()->with(['error'=>'product is already exists']);
            }
            Cart::create([
                'user_id'=>$user_id,
                'product_id'=>$product_id,
                'quantity'=> $request->quantity
            ]);  

            return redirect()->route('carts.index');
        }else{
            return view('auth.register');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        //
        if(Auth::check()){
            $user_id =Auth::user()->id;
            if(Cart::where('product_id',$id)->where('user_id',$user_id)->exists()){
                 Cart::where('product_id',$id)->where('user_id',$user_id)->delete();
                return redirect()->back()->with(['success'=>'Product is deleted successfully from wishlist']);
            }
        }else{
            return redirect()->back()->with(['error'=>'Login to continue ..']);
        }
    }
}
