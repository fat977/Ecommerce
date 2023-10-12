<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Website\Auth\LoginRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function login(LoginRequest $request){
        //$authenticatedUser = Auth::guard('sanctum')->user();
        $user = User::where('email',$request->email)->first();

        if(! Hash::check($request->password,$user->password)){
            return response()->json(
                [
                    'message'=>'wrong attempt',
                    'errors'=> ['email'=>'The credentials are incorrect'],
                    'data'=>(object)[],
                ],401);
        }
        $user->token = 'Bearer '.$user->createToken($request->device_name)->plainTextToken;

        if($user->is_banned = 0){
            return response()->json(['message'=>'wrong attempt','errors'=> "this user is banned",'data'=>compact('user')],401);
        }
        return response()->json(['message'=>'','errors'=> "",'data'=>compact('user')],201);
    }

    public function logout(Request $request){
        $authenticatedUser = Auth::guard('sanctum')->user();
        $token = $request->header('Authorization');
        $bearerWithId = explode('|',$token)[0];
        $tokenId = str_replace('Bearer ','',$bearerWithId);
        $authenticatedUser->tokens()->where('id',$tokenId)->delete();
        return response()->json(
            [
                'message'=>"this user is logged out of this device",
                'errors'=>(object)[],
                'data'=>(object)[],
            ],200);
    }

    public function logoutAllDevices(){
        $authenticatedUser = Auth::guard('sanctum')->user();
        $authenticatedUser->tokens()->delete();
        return response()->json(
            [
                'message'=>"this user is logged out of this device",
                'errors'=>(object)[],
                'data'=>(object)[],
            ],200);
    }
}
