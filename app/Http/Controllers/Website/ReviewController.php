<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\ReviewRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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

            $verified_purchase = Order::where('orders.address_id',Auth::user()->addresses[0]->id)->
            join('products_orders','orders.id','products_orders.order_id')
            ->where('products_orders.product_id',$product_id)->get();

            if($verified_purchase->count() > 0){
                $existing_review = Review::where('user_id',$user_id)->where('product_id',$product_id)->first();
                $product = Product::query()->where('id', $product_id)->first();

                if($existing_review){
                    return view('website.reviews.edit-review',compact('existing_review','product'));
                }else{
                    Review::create([
                        'user_id'=>$user_id,
                        'product_id'=>$product_id,
                        'review'=> $data['review'],
                        'value'=> $data['product_rating']
                    ]); 
                } 
            }else{
                return redirect()->back()->with('error','you can not rate this product without purchase');
            }

            return redirect()->back()->with('success','Review is added successfully');
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
    public function edit($id)
    {
        $product = Product::where('id',$id)->where('status',1)->first();
        if($product){
            $product_id =$product->id;
            $existing_review = Review::where('user_id',Auth::user()->id)->where('product_id',$product_id)->first();
            //dd($review);
            if($existing_review){
                return view('website.reviews.edit-review',compact('existing_review','product'));
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function updateReview(Request $request){
        $user_review = $request->input('review');
        $stars = $request->input('value');
        $product_id = $request->input('product_id');
        if($user_review != ''){
            Review::where('product_id',$product_id)->where('user_id',Auth::user()->id)->update([
                'review'=> $user_review,
                'value' => $stars
            ]);
            return redirect()->back()->with('success','review is updated successfully');
        }else{
            return redirect()->back()->with('error','You can not submit an empty review');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteReview(Request $request)
    {
        //
        if(Auth::check()){
            $product_id = $request->input('product_id');
            if(Review::where('product_id',$product_id)->where('user_id',Auth::id())->exists()){
                $RatingItem = Review::where('product_id',$product_id)->where('user_id',Auth::id())->delete();
               
                return redirect()->back()->with('success','review is deleted successfully');
            }
        }
    }
}
