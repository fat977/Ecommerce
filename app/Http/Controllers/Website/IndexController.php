<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        //
        $offers = Offer::get();
        foreach($offers as $offer){
            if($offer->end_at < Date('Y-m-d H:i:s')){
                Offer::query()->where('end_at','<', Date('Y-m-d H:i:s'))->delete();    
            }
        }
       
        $banners = Banner::query()->where('status',1)->get();
        $newProducts = Product::orderBy('id','Desc')->where('status',1)->limit(5)->get();
        return view('website.index',compact('banners','newProducts'));
    }
}
