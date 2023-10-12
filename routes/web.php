<?php

use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CheckoutController;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Website\PayPalController;
use App\Http\Controllers\Website\ProductController;
use App\Http\Controllers\Website\ReviewController;
use App\Http\Controllers\Website\WishlistController;
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

/* Route::get('/', function () {
    return view('welcome');
});
 */

Route::get('/',IndexController::class)->name('website');
Route::group(['prefix'=>'products','as'=>'product.'],function(){
    Route::get('/{category_id}',[ProductController::class,'productsByCategory'])->name('category');
    Route::get('details/{product_id}',[ProductController::class,'productDetails'])->name('details');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'updateAddress'])->name('profile.updateAddress');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('carts',CartController::class);
Route::get('delete/{product_id}',[CartController::class,'delete'])->name('carts.delete');

Route::resource('reviews', ReviewController::class);
Route::post('update-review',[ReviewController::class,'updateReview'])->name('review.update');
Route::post('delete-review',[ReviewController::class,'deleteReview'])->name('review.delete');

//wishlist
Route::group(['prefix'=>'wishlists','as'=>'wishlists.'],function(){
    Route::get('index',[WishlistController::class,'index'])->name('index');
    Route::post('store',[WishlistController::class,'store'])->name('store');
    Route::delete('delete-wishlist-item/{product_id}',[WishlistController::class,'delete'])->name('destroy');
});

//checkout
Route::get('orders/checkout',[CheckoutController::class,'checkout'])->name('order.checkout');
Route::post('orders/place-order',[CheckoutController::class,'placeOrder'])->name('order.placeOrder');
Route::get('orders/history',[CheckoutController::class,'history'])->name('order.history');
Route::get('orders/details/{id}',[CheckoutController::class,'orderDetails'])->name('order.details');

//paypal
Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
Route::get('payment-success',[PayPalController::class,'success'])->name('payment.success');
Route::controller(FacebookController::class)->group(function(){
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});

Route::get('auth/google', [GoogleController::class, 'signInwithGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'callbackToGoogle']);

require __DIR__.'/auth.php';
