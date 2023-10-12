<?php

namespace App\Http\Controllers\Dashboard\Product\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\Offer\OfferRequest;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $offers = Offer::query()->get();
        return view('dashboard.products.offers.index',compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.products.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfferRequest $request)
    {
        //
        $data = $request->validated();
        
        Offer::create($data);
       
        if($request->page =='back'){
            return redirect()->back()->with('success','Offer is created successfully');
        }else{
            return redirect()->route('admin.offers.index');
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
        //
        $offer = Offer::findOrFail($id);
        $categories = Category::select('id','name_en','name_ar')->where('status',1)->get();
        return view('dashboard.products.offers.edit',compact('offer','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OfferRequest $request,$id)
    {
        //
        $offer = Offer::findOrFail($id);
        $data = $request->validated();
        $offer->update($data);
        return redirect()->route('admin.offers.index')->with('success','offer is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
      /*   $offer = Offer::query()->where('id',$id)->first();
        //dd($offer);
        if($offer->end_at < Date('Y-m-d H:i:s')){
            Offer::query()->where('id',$id)->delete();
            return redirect()->back()->with('success','Offer is deleted successfully');

        }else{
            return redirect()->back()->with('error','not');

        } */
        Offer::query()->where('id',$id)->delete();
        return redirect()->back()->with('success','Offer is deleted successfully');

        //$offer->delete();
    }
}
