<?php
namespace App\Http\traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait calcPrice{
    public function totalPrice(){
        $user_id =Auth::user()->id;
        $user = User::with('products','addresses')->find($user_id);
        $discountedProducts = DB::table('products_discount')->get();

        $total_price =0;
        foreach ($user->products as $product){
            foreach ($discountedProducts as $sale){
                if ($sale->name_en == $product->name_en){
                    $total_price += ($sale->price_after_discount) * ($product->pivot->quantity);
                }
            }
            $total_price += ( $product->price * $product->pivot->quantity);

        }
        session()->put('total_price', $total_price);
        return $total_price;
    }
}