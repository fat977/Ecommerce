<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\ForgotPasswordRequest;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use App\Http\Requests\Dashboard\Auth\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    //
    public function loginPage(){
        if(Auth::guard('admin')->user()){
            return redirect()->back();
        }else{
            return view('dashboard.Auth.login');
        }
       
    }

    public function login(LoginRequest $request){
        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>1])){
            return redirect('dashboard');
        }else{
            return redirect()->back()->with('error','wrong attempt!');
        }
    }

    public function forgotPasswordPage(){
        return view('dashboard.Auth.forgot-password');
    }

    public function forgotPassword(ForgotPasswordRequest $request){
      
        $admin = Admin::where('email',$request->email)->first();
        
        Mail::to($admin)->send(new ResetPassword($admin));
        return redirect()->back()->with('success','We have emailed your password reset link.');
    }

    public function resetPasswordPage(Request $request){
        
        $admin = Admin::where('email',$request->email)->first();
        return view('dashboard.Auth.reset-password',compact('admin'));
    }

    public function resetPassword(ResetPasswordRequest $request){
        $admin = Admin::where('email',$request->email)->first();
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect()->route('admin.login.page');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('dashboard/login-page');
    }
}
