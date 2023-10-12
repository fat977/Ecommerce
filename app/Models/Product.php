<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Product extends Model
{
    use HasFactory;
    protected $guarded =[];

    protected function nameEn(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtolower($value),
        );
    }
   
    public function category(){
        return $this->belongsTo(Category::class,'category_id')->select('section_id','id','name_en');
    }
    
    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function specs(){
        return $this->belongsToMany(Spec::class,'products_specs')
        ->select('id','name_'.LaravelLocalization::getCurrentLocale() . ' as name')->withPivot('value')->withTimestamps();
    }

    public function offers(){
        return $this->belongsToMany(Offer::class,'products_offers')->withPivot('price')->withTimestamps();
    }

    public function orders(){
        return $this->belongsToMany(Order::class,'products_orders')->withPivot('price','quantity')->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany(User::class,'carts')->withPivot('quantity')->withTimestamps();
    }

    public function user_wishlists(){
        return $this->belongsToMany(User::class,'wishlists')->withTimestamps();
    }

    public function user_reviews(){
        return $this->belongsToMany(User::class,'reviews')->withPivot('value','review')->withTimestamps();
    }
}
