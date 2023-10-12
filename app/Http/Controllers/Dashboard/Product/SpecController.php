<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\Spec\SpecRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Spec;
use Illuminate\Http\Request;

class SpecController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $specs = Spec::query()->get();
        return view('dashboard.products.specs.index',compact('specs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //$products = Product::all();
        $categories = Category::select('id','name_en','name_ar')->where('status',1)->get();
        return view('dashboard.products.specs.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpecRequest $request)
    {
        //
        $data = $request->validated();
        
        Spec::create($data);
       
        if($request->page =='back'){
            return redirect()->back()->with('success','Spec is created successfully');
        }else{
            return redirect()->route('admin.specs.index');
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
        $spec = Spec::findOrFail($id);
        $categories = Category::select('id','name_en','name_ar')->where('status',1)->get();
        return view('dashboard.products.specs.edit',compact('spec','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpecRequest $request,$id)
    {
        //
        $spec = Spec::findOrFail($id);
        $data = $request->validated();
        $spec->update($data);
        //$spec->products()->sync($request->products);
        return redirect()->route('admin.specs.index')->with('success','Spec is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Spec::findOrFail($id)->delete();
        return redirect()->back()->with('success','Spec is deleted successfully');
    }
}
