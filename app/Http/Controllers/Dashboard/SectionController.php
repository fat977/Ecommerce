<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SectionRequest;
use App\Http\traits\media;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    use media;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sections = Section::query()->get();
        return view('dashboard.sections.index',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        //
        $data = $request->validated();
        // upload image
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->image,'public/sections');
        }
        Section::create($data);

        if($request->page =='back'){
            return redirect()->back()->with('success','Section is created successfully');
        }else{
            return redirect()->route('admin.sections.index');
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
        $section = Section::findOrFail($id);
        return view('dashboard.sections.edit',compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request,$id)
    {
        //
        $section = Section::findOrFail($id);
        $data = $request->validated();
        
        // upload image
        if ($request->hasFile('image')) {
            if ($section->image != null) {
                Storage::disk('local')->delete('public/sections/' . $section->image);
            }

            $data['image'] = $this->uploadImage($request->image,'public/sections');
            $section->update(['image' => $data['image']]);
        }
        $section->update($data);
        return redirect()->back()->with('success','Section is updated successfully');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $section = Section::findOrFail($id);
        if ($section->image != null) {
            Storage::disk('local')->delete('public/sections/' . $section->image);
        }
        $section->delete();
        return redirect()->back()->with('success','Section is deleted successfully');
    }
}
