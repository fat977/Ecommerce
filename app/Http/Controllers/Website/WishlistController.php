<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function index()
    {
        //
        if(Auth::check()){
            $user_id =Auth::user()->id;
            $wislists = Wishlist::query()->where('user_id',$user_id);
            $user = User::with('products')->find($user_id);
            return view('website.wishlist.index',compact('user','wislists')); 
        }else{
            return view('auth.register');
        }   
    }

    public function store(Request $request)
    {
        //
        if(Auth::check()){
            $data = $request->except('_token');
            $product_id = $data['product_id'];
            $user_id =Auth::user()->id;

            //check if product is exist or not
            $existProduct = Wishlist::query()->where(['user_id'=> $user_id , 'product_id'=>$product_id])->exists();
            if($existProduct){
                return redirect()->back()->with(['error'=>'product is already exists']);
            }

            Wishlist::create([
                'user_id'=>$user_id,
                'product_id'=>$product_id
            ]);
            return redirect()->route('wishlists.index');
        }else{
            return view('auth.register');
        }   
    }

    public function delete($product_id){
        if(Auth::check()){
            $user_id =Auth::user()->id;
            if(Wishlist::where('product_id',$product_id)->where('user_id',$user_id)->exists()){
                $wishlistItem = Wishlist::where('product_id',$product_id)->where('user_id',$user_id)->delete();
                return redirect()->back()->with(['success'=>'Product is deleted successfully from wishlist']);
            }
        }else{
            return redirect()->back()->with(['error'=>'Login to continue ..']);
        }
            /* if(Auth::check()){
                $product_id = $request->input('product_id');
                if(Wishlist::where('product_id',$product_id)->where('user_id',Auth::user()->id)->exists()){
                    $wishlistItem = Wishlist::where('product_id',$product_id)->where('user_id',Auth::user()->id)->first();
                    
                    $wishlistItem->delete();
                    return response()->json(['status'=>'Product is deleted successfully from wishlist']);
                }
            }else{
                return response()->json(['status'=>'Login to continue']);
            } */
    }
}
