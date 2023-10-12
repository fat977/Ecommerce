<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Http\traits\media;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use media;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::query()->with('section')->get();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $sections = Section::select('id','name_en','name_ar')->where('status',1)->get();
        return view('dashboard.categories.create',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = $this->uploadImage($request->image,'public/categories');
        }
        Category::create($data);
        if($request->page =='back'){
            return redirect()->back()->with('success','Category is created successfully');
        }else{
            return redirect()->route('admin.categories.index');
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
        $category = Category::findOrFail($id);
        $sections = Section::select('id','name_en','name_ar')->where('status',1)->get();
        return view('dashboard.categories.edit',compact('category','sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request,$id)
    {
        //
        $category = Category::findOrFail($id);
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            // delete image
            if ($category->image != null) {
                Storage::disk('local')->delete('public/categories/' . $category->image);
            }

            $data['image'] = $this->uploadImage($request->image,'public/categories');
            $category->update(['image' => $data['image']]);
        }
        $category->update($data);
        return redirect()->route('admin.categories.index')->with('success','Category is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $category = Category::findOrFail($id);
        if($category->image != null){
            Storage::disk('local')->delete('public/categories/'.$category->image);
        }
        $category->delete();
        return redirect()->back()->with('success','Category is deleted successfully');
    }
}
