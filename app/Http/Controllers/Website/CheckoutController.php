<?php

namespace App\Http\Controllers\Website;

use App\Events\OrderNotification;
use App\Http\Controllers\Controller;
use App\Http\traits\calcPrice;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class CheckoutController extends Controller
{
    use calcPrice;
    //
    public function checkout(){

        if(Auth::check()){
            $user_id =Auth::user()->id;
            $carts = Cart::query()->where('user_id',$user_id)->get();
            $user = User::with('products')->find($user_id);
            $discountedProducts = DB::table('products_discount')->get();
            return view('website.orders.checkout',compact('carts','user','discountedProducts'));  
        }else{
            return view('auth.register');
        }
       
    }

    public function placeOrder(Request $request){
        //dd($request->all());
        if($request->payment_method == 'PayPal'){
            return view('website.orders.paypal.index');
        }
        $startTime = date("Y-m-d");
        $delivered_at = date('Y-m-d',strtotime('+1 day',strtotime($startTime)));

        $user_id =Auth::user()->id;
        $user = User::with('products','addresses')->find($user_id);
        if(empty($user->addresses[0]->id)){
            return redirect()->route('profile.edit');
        }
        //dd($user);
        $discountedProducts = DB::table('products_discount')->get();

        /* $total_price =0;
        foreach ($user->products as $product){
            foreach ($discountedProducts as $sale){
                if ($sale->name_en == $product->name_en){
                    $total_price += ($sale->price_after_discount) * ($product->pivot->quantity);
                }
            }
            $total_price += ( $product->price * $product->pivot->quantity);

        } */
       
        $order = new Order();
        $order->payment_method = $request->payment_method;
        $order->status = 0;
        $order->delivered_at= $delivered_at;
        $order->address_id=$user->addresses[0]->id;
        $order->total_price = $this->totalPrice();
        $order->save();
       
        foreach ($user->products as $product){
            foreach ($discountedProducts as $sale){
                if ($sale->name_en == $product->name_en){
                    $price = ($sale->price_after_discount) * ($product->pivot->quantity);
                }
            }
            $price = ( $product->price * $product->pivot->quantity);
           
            DB::table('products_orders')->insert([
                'product_id'=>$product->id,
                'order_id'=>$order->id,
                'price'=>$price,
                'quantity'=>$product->pivot->quantity,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            $products = Product::query()->where('id',$product->id)->with('users')->first();
            $newQuantity = ($products->quantity) - ($product->pivot->quantity);
            Product::query()->where('id',$product->id)->update(['quantity'=>$newQuantity]);
        }
        Cart::query()->where('user_id',$user_id)->delete();

        // send notification
        $admin = Admin::where('status',1)->get();
        $order = Order::latest()->first();
        Notification::send($admin,new NewOrder($order));
        $notification_count = DB::table('notifications')->where('read_at',null)->count();
        event(new OrderNotification($notification_count));
        return redirect()->route('order.history')->with(['success'=>'ordered placed successfully']);

    }

    public function history(){
        if(Auth::check()){
            $address_id =Auth::user()->addresses[0]->id;
            $orders = Order::query()->where('address_id',$address_id)->get();
            return view('website.orders.history',compact('orders'));
        }else{
            return redirect('register');
        }
        
    }

    public function orderDetails($id){
        $order = Order::with('address','products')->where('id',$id)->first();
        return view('website.orders.view-order',compact('order'));
    }
}
