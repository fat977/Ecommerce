<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\RegisterRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
   /*  public function __construct()
    {
        $this->authorizeResource(Admin::class, 'admin');
    } */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $this->authorize('viewAny',Admin::class);

        $admins = Admin::get();
        return view('dashboard.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('create', Admin::class);

        return view('dashboard.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        //
        $this->authorize('create', Admin::class);
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        Admin::create($data);
        return redirect()->route('admin.admins.index')->with('success','Admin is created successfully');
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
        $admin = Admin::findOrFail($id);
        
        $this->authorize('update', $admin);
        return view('dashboard.admins.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $admin = Admin::findOrFail($id);
        $this->authorize('update', $admin);

        $data = $request->except('_token','_method');
        if($admin->status ==1){
            $admin->status =0;
        }else{
            $admin->status=1;
        }
        $admin->update($data);
        return redirect()->back()->with('success','Admin is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $admin = Admin::findOrFail($id);
        $this->authorize('delete', $admin);

        if($admin->image != null){
            Storage::disk('avatars')->delete($admin->image);
        }
        $admin->delete();
        return redirect()->back()->with('success','Category is deleted successfully');
    }
}
