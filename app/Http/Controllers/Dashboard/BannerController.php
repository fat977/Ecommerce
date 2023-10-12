<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BannerRequest;
use App\Http\traits\media;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    use media;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $banners = Banner::all();
        return view('dashboard.banners.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        //
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = $this->uploadImage($request->image,'public/banners');
        }
        Banner::create($data);
        if($request->page =='back'){
            return redirect()->back()->with('success','Banner is created successfully');
        }else{
            return redirect()->route('admin.banners.index');
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
        $banner = Banner::findOrFail($id);
        return view('dashboard.banners.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request,$id)
    {
        //
        $banner = Banner::findOrFail($id);
        $data = $request->validated();
       
        if($request->hasFile('image')){
            if($banner->image != null){
                Storage::disk('local')->delete('public/banners/'.$banner->image);
            }
            $data['image'] = $this->uploadImage($request->image,'public/banners');
            $banner->update(['image' => $data['image']]);
        }
        $banner->update($data);
        return redirect()->back()->with('success','Banner is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $banner = Banner::findOrFail($id);
        if($banner->image != null){
            Storage::disk('local')->delete('public/banners/'.$banner->image);
        }
        $banner->delete();
        return redirect()->back()->with('success','Banner is deleted successfully');
    }
}
