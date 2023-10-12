<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $touches = ['products'];

    public function products(){
        return $this->belongsToMany(Product::class,'products_orders')
        ->select('products.id','image','name_'.LaravelLocalization::getCurrentLocale() . ' as name')
        ->withPivot('price','quantity');
    }

    public function address(){
        return $this->belongsTo(Address::class,'address_id');
    }
}
