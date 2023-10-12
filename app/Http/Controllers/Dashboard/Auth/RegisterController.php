<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\RegisterRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function registerPage(){
       /*  if(Auth::guard('admin')->user()){
            return redirect()->back();
        }else{ */
            return view('dashboard.Auth.register');
        //}
        
    }

    public function register(RegisterRequest $request){
        $data = $request->except('password','password_confirmation');
        $data['password']= Hash::make($request->password);
        $user = Admin::create($data);
        return redirect()->route('admin.dashboard');
    }
}
