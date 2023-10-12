<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'users'],function(){
    Route::post('register',RegisterController::class);
    Route::post('login',[LoginController::class,'login']);
    Route::delete('logout',[LoginController::class,'logout']);
    Route::delete('logout-all-devices',[LoginController::class,'logoutAllDevices']);
});

Route::resource('products',ProductController::class);

