<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\User\AddressRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $lang = App::currentLocale();
        $user = User::with('addresses')->find(Auth::user()->id);
        
        $cities = City::with('regions')->select('id','name_'.$lang.' AS name')->where('status',1)->get();
        //dd($cities);
        $regions = Region::query()->select('id','name_'.$lang.' AS name')->where('status',1)->get();
        
        return view('profile.edit', [
            'user' => $request->user(),
            'cities'=>$cities,
            'regions'=>$regions,
            'user'=>$user
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', 'profile is updated successfully');
    }

    public function updateAddress(AddressRequest $request){
        $data = $request->except('_token','_method','city_id');

        $address = new Address;
        $address->user_id =Auth::user()->id;
        $address->region_id =$data['region_id'];
        $address->street =$data['street'];
        $address->building =$data['building'];
        $address->floor =$data['floor'];
        $address->note =$data['note'];
        $address->save();

        return redirect()->back()->with('success','Address is updated successfully');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
