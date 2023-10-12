<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfileRequest;
use App\Http\traits\media;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use media;
    //
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('dashboard.admins.profile.edit', compact('admin'));
    }

    public function updatePersonalData(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $data = $request->except('_token', 'image');

        if ($request->hasFile('image')) {
            if ($admin->image != null) {
                Storage::disk('avatars')->delete($admin->image);
            }

            $data['image'] = $this->uploadAvatar($request->image);
            $admin->update(['image' => $data['image']]);
        }
        $admin->update($data);
        return redirect()->back()->with('success', 'Personal Information are updated successfully');
    }

    public function updatePassword(ProfileRequest $request)
    {
        //dd($request->all());
        $data = $request->validated();
        if (!empty($request->current_password)) {
            if (Hash::check($data['current_password'], Auth::user()->password)) {
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => Hash::make($request->new_password)]);
                return redirect()->back()->with(['success' => 'Password is updated']);
            } else {
                return redirect()->back()->with(['error' => 'current password is invalid']);
            }
        }
       
    }
}
