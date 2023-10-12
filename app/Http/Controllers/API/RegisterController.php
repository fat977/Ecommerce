<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Website\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        //
        $data = $request->except('password','password_confirmation');
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $user->token = "Bearer ".$user->createToken($request->device_name)->plainTextToken;
        return response()->json(['message'=>'','errors'=> "",'data'=>compact('user')],201);
    }
}
