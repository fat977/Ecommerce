<?php

use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\ProfileController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Auth\RegisterController;
use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\Product\Offer\OfferController;
use App\Http\Controllers\Dashboard\Product\Offer\ProductOfferController;
use App\Http\Controllers\Dashboard\Product\ProductController;
use App\Http\Controllers\Dashboard\Product\ProductSpecController;
use App\Http\Controllers\Dashboard\Product\SpecController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['prefix'=>'dashboard','as'=>'admin.'],function(){
    
    Route::get('login-page',[LoginController::class,'loginPage'])->name('login.page');
    Route::post('login',[LoginController::class,'login'])->name('login');

    Route::get('register-page',[RegisterController::class,'registerPage'])->name('register.page');
    Route::post('register',[RegisterController::class,'register'])->name('register');

    Route::get('forgot-password-page',[LoginController::class,'forgotPasswordPage'])->name('forgotPassword.page');
    Route::post('forgot-password',[LoginController::class,'forgotPassword'])->name('forgotPassword');

    Route::get('reset-password-page/{email}',[LoginController::class,'resetPasswordPage'])->name('resetPassword.page');
    Route::post('reset-password',[LoginController::class,'resetPassword'])->name('resetPassword');

    Route::group(['middleware'=>'auth:admin'],function(){
        Route::get('/',IndexController::class )->name('dashboard');
        Route::post('logout',[LoginController::class,'logout'])->name('logout');

        Route::group(['prefix'=>'profile','as'=>'profile.'],function(){
            Route::get('/',[ProfileController::class,'index'])->name('index');
            Route::post('update-personal-data/{id}',[ProfileController::class,'updatePersonalData'])->name('updatePersonalData');
            Route::post('update-password/{id}',[ProfileController::class,'updatePassword'])->name('updatePassword');
        });

        Route::group(['prefix'=>'product'],function(){
            Route::resource('products',ProductController::class);
            //Excel
            Route::get('export-excel',[ProductController::class,'export'])->name('product.export');
            Route::post('import-excel',[ProductController::class,'import'])->name('product.import');

            Route::resource('specs',SpecController::class);
            Route::group(['prefix'=>'spec','as'=>'spec.'],function(){
                Route::get('create/{id}',[ProductSpecController::class,'createSpec'])->name('create');
                Route::post('store/{id}',[ProductSpecController::class,'storeSpec'])->name('store');
                Route::get('edit/{product_id}/{spec_id}',[ProductSpecController::class,'editSpec'])->name('edit');
                Route::post('update/{product_id}/{spec_id}',[ProductSpecController::class,'updateSpec'])->name('update');
                Route::post('delete/{product_id}/{spec_id}',[ProductSpecController::class,'deleteSpec'])->name('delete');
            });

            Route::resource('offers',OfferController::class);
            Route::group(['prefix'=>'offer','as'=>'offer.'],function(){
                Route::get('create/{id}',[ProductOfferController::class,'createOffer'])->name('create');
                Route::post('store/{id}',[ProductOfferController::class,'storeOffer'])->name('store');
                Route::get('edit/{product_id}/{offer_id}',[ProductOfferController::class,'editOffer'])->name('edit');
                Route::post('update/{product_id}/{offer_id}',[ProductOfferController::class,'updateOffer'])->name('update');
                Route::post('delete/{product_id}/{offer_id}',[ProductOfferController::class,'deleteOffer'])->name('delete');
            });
        });

        Route::resource('sections',SectionController::class);
        Route::resource('categories',CategoryController::class);
        Route::resource('brands',BrandController::class);
        Route::resource('banners',BannerController::class);
  
        Route::resource('admins',AdminController::class);

        Route::resource('users',UserController::class);
        Route::get('users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
        Route::delete('users/delete_permanently/{id}', [UserController::class, 'deletePermanently'])->name('user.deletePermanently');
    });

    Route::group(['prefix'=>'orders','as'=>'orders.'],function(){
        Route::get('/',[OrderController::class,'index'])->name('index');
        Route::get('view/{id}',[OrderController::class,'viewOrder'])->name('view');
        Route::post('update-orders/{id}',[OrderController::class,'updateOrder'])->name('update');
        Route::get('MarkAsRead_all',[OrderController::class,'MarkAsRead_all'])->name('MarkAsRead_all');

    });
});


