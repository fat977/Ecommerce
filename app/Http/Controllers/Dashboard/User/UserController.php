<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = User::query();
        if ($request->has('trashed')) {
            $query->onlyTrashed()->get();
        }
        $users = $query->get();
        return view('dashboard.users.index',compact('users'));
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
        $user = User::findOrFail($id);
        return view('dashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request,$id)
    {
        //
        $user = User::findOrFail($id);
        $validated = $request->validated();
        
        $user->update([
            'is_banned' => $validated['is_banned'],
            'banned_until' => $validated['is_banned'] == 0 ? null : $validated['banned_until'],
        ]);
        //dd($validated);
        //$user->update($validated);
        return redirect()->route('admin.users.index')->with(['success' => 'User is updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $user = User::query()->findOrFail($id);
        $user->delete();
        return redirect()->back()->with(['success' => 'User is updated successfully']);

    }

    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
  
        return redirect()->route('admin.users.index')->with(['success' => 'User is restored successfully']);
    }  

    public function deletePermanently($id){
        User::query()->where('id',$id)->forceDelete();
        return redirect()->route('admin.users.index')->with(['success' => 'User is deleted permanently successfully']);
    }
  
}
