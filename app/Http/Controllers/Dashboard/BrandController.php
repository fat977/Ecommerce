<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BrandRequest;
use App\Http\traits\media;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    use media;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brands = Brand::query()->where('status',1)->with('category')->get();
        return view('dashboard.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::select('id','name_en','name_ar')->where('status',1)->get();
        return view('dashboard.brands.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        //
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = $this->uploadImage($request->image,'public/brands');
        }
        Brand::create($data);
        if($request->page =='back'){
            app('flasher')->addSuccess('Brand is added successfully');
            return redirect()->back();
        }else{
            app('flasher')->addSuccess('Brand is added successfully');
            return redirect()->route('admin.brands.index');
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
        $brand = Brand::findOrFail($id);
        $categories = Category::select('id','name_en','name_ar')->where('status',1)->get();
        return view('dashboard.brands.edit',compact('brand','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request,$id)
    {
        //
        $brand = Brand::findOrFail($id);
        $data = $request->validated();
        if($request->hasFile('image')){
            if($brand->image != null){
                Storage::disk('local')->delete('public/brands/'.$brand->image);
            }
            $data['image'] = $this->uploadImage($request->image,'public/brands');
            $brand->update(['image' => $data['image']]);
        }
        $brand->update($data);
        app('flasher')->addInfo('Brand is updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $brand = Brand::findOrFail($id);
        if($brand->image != null){
            Storage::disk('local')->delete('public/categories/'.$brand->image);
        }
        $brand->delete();
        app('flasher')->addSuccess('Brand is deleted successfully');
        return redirect()->back();
    }
}
